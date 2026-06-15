<?php
/**
 * Artisan Runner — temporary web-based artisan executor for cPanel.
 * Upload to public/, use it, then DELETE IT from the server.
 */

ini_set('display_errors', 0);
error_reporting(E_ALL);

define('PASSWORD', 'dbschenker2026!');
define('BASE_DIR', dirname(__DIR__));
define('ARTISAN_PHP', PHP_BINARY);

session_start();

$authenticated = isset($_SESSION['auth']) && $_SESSION['auth'] === true;
$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] === PASSWORD) {
        $_SESSION['auth'] = true;
        $authenticated = true;
    } else {
        $loginError = 'Wrong password.';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$output = '';
$commandRan = '';
$execError = '';

function runArtisan(string $cmd): array
{
    $artisan  = BASE_DIR . '/artisan';
    $phpBin   = ARTISAN_PHP;
    $fullArgs = $phpBin . ' ' . $artisan . ' ' . $cmd;

    // Try proc_open first (best output capture)
    if (function_exists('proc_open')) {
        $desc = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];
        $env = array_merge($_ENV, ['HOME' => BASE_DIR, 'PATH' => '/usr/local/bin:/usr/bin:/bin']);
        $proc = proc_open($fullArgs, $desc, $pipes, BASE_DIR, $env);
        if (is_resource($proc)) {
            fclose($pipes[0]);
            $out = stream_get_contents($pipes[1]);
            $err = stream_get_contents($pipes[2]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($proc);
            return ['output' => $out . ($err ? "\n[stderr]\n" . $err : ''), 'method' => 'proc_open'];
        }
    }

    // Try exec
    if (function_exists('exec')) {
        $out = [];
        exec($fullArgs . ' 2>&1', $out);
        return ['output' => implode("\n", $out), 'method' => 'exec'];
    }

    // Try shell_exec
    if (function_exists('shell_exec')) {
        $out = shell_exec($fullArgs . ' 2>&1');
        return ['output' => $out ?? '', 'method' => 'shell_exec'];
    }

    // Try passthru via output buffering
    if (function_exists('passthru')) {
        ob_start();
        passthru($fullArgs . ' 2>&1');
        $out = ob_get_clean();
        return ['output' => $out, 'method' => 'passthru'];
    }

    return ['output' => '', 'method' => 'none', 'error' => 'All shell execution functions are disabled (proc_open, exec, shell_exec, passthru). Contact your host to enable one of them.'];
}

if ($authenticated && $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['cmd'])) {
    $cmd = trim($_POST['cmd']);
    $cmd = preg_replace('/^(php\s+)?artisan\s+/', '', $cmd);
    $commandRan = $cmd;

    $result   = runArtisan($cmd);
    $output   = $result['output'];
    $execError = $result['error'] ?? '';
    if (empty($output) && empty($execError)) {
        $output = '(No output returned)';
    }
}

$groups = [
    'Cache & Optimize' => [
        'config:clear'    => 'config:clear',
        'route:clear'     => 'route:clear',
        'view:clear'      => 'view:clear',
        'cache:clear'     => 'cache:clear',
        'optimize:clear'  => 'optimize:clear',
        'optimize'        => 'optimize',
        'config:cache'    => 'config:cache',
        'route:cache'     => 'route:cache',
        'view:cache'      => 'view:cache',
    ],
    'Database' => [
        'migrate --force'              => 'migrate --force',
        'migrate:status'               => 'migrate:status',
        'migrate:rollback --force'     => 'migrate:rollback --force',
        'migrate:fresh --force'        => 'migrate:fresh --force',
        'db:seed --force'              => 'db:seed --force',
        'migrate:fresh --seed --force' => 'migrate:fresh --seed --force',
    ],
    'Storage & Queue' => [
        'storage:link --force' => 'storage:link --force',
        'queue:restart'        => 'queue:restart',
        'queue:work --once'    => 'queue:work --once',
        'schedule:run'         => 'schedule:run',
    ],
    'App Info' => [
        'about'                => 'about',
        'env'                  => 'env',
        'route:list'           => 'route:list',
        'package:discover'     => 'package:discover',
        'key:generate --force' => 'key:generate --force',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artisan Runner</title>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: system-ui, sans-serif; background: #0f172a; color: #e2e8f0; min-height: 100vh; }

  /* Login */
  .login-wrap { display: flex; align-items: center; justify-content: center; min-height: 100vh; }
  .login-box { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 2.5rem; width: 100%; max-width: 380px; }
  .login-box h1 { font-size: 1.3rem; margin-bottom: 1.5rem; color: #f1f5f9; }
  .login-box input[type=password] { width: 100%; padding: .65rem .9rem; background: #0f172a; border: 1px solid #475569; border-radius: 8px; color: #f1f5f9; font-size: 1rem; margin-bottom: 1rem; }
  .btn-login { width: 100%; padding: .7rem; background: #3b82f6; color: #fff; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; }
  .btn-login:hover { background: #2563eb; }
  .error { color: #f87171; margin-bottom: 1rem; font-size: .9rem; }

  /* App */
  header { background: #1e293b; border-bottom: 1px solid #334155; padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; }
  header h1 { font-size: 1rem; color: #f1f5f9; }
  header a { color: #94a3b8; font-size: .85rem; text-decoration: none; }
  header a:hover { color: #f87171; }
  .container { max-width: 1100px; margin: 0 auto; padding: 1.5rem; }
  .warning { background: #7c2d12; border: 1px solid #c2410c; border-radius: 8px; padding: .85rem 1.1rem; margin-bottom: 1.5rem; font-size: .87rem; color: #fdba74; }
  .custom-form { background: #1e293b; border: 1px solid #334155; border-radius: 10px; padding: 1.25rem; margin-bottom: 1.5rem; display: flex; gap: .75rem; }
  .custom-form input[type=text] { flex: 1; padding: .6rem .9rem; background: #0f172a; border: 1px solid #475569; border-radius: 8px; color: #f1f5f9; font-size: .95rem; font-family: monospace; }
  .custom-form input::placeholder { color: #64748b; }
  .btn-run { padding: .6rem 1.4rem; background: #10b981; color: #fff; border: none; border-radius: 8px; font-size: .9rem; cursor: pointer; white-space: nowrap; }
  .btn-run:hover { background: #059669; }
  .output-box { background: #020617; border: 1px solid #1e3a5f; border-radius: 10px; padding: 1.25rem; margin-bottom: 1.75rem; }
  .output-box .cmd-label { color: #38bdf8; font-family: monospace; font-size: .85rem; margin-bottom: .75rem; }
  .output-box pre { color: #86efac; font-family: monospace; font-size: .85rem; white-space: pre-wrap; word-break: break-word; line-height: 1.6; }
  .output-box pre.err { color: #f87171; }
  .groups { display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 1.25rem; }
  .group { background: #1e293b; border: 1px solid #334155; border-radius: 10px; padding: 1.1rem; }
  .group h3 { font-size: .8rem; text-transform: uppercase; letter-spacing: .07em; color: #64748b; margin-bottom: .85rem; }
  .group form { margin-bottom: .4rem; }
  .cmd-btn { width: 100%; text-align: left; background: #0f172a; border: 1px solid #334155; border-radius: 6px; color: #cbd5e1; font-family: monospace; font-size: .8rem; padding: .45rem .7rem; cursor: pointer; transition: background .15s; }
  .cmd-btn:hover { background: #1e3a5f; color: #f1f5f9; border-color: #3b82f6; }
  .footer { text-align: center; padding: 1.5rem; color: #475569; font-size: .78rem; margin-top: 1rem; }
</style>
</head>
<body>

<?php if (!$authenticated): ?>

<div class="login-wrap">
  <div class="login-box">
    <h1>Artisan Runner</h1>
    <?php if ($loginError): ?>
      <p class="error"><?= htmlspecialchars($loginError) ?></p>
    <?php endif; ?>
    <form method="POST">
      <input type="password" name="password" placeholder="Enter password" autofocus>
      <button type="submit" class="btn-login">Unlock</button>
    </form>
  </div>
</div>

<?php else: ?>

<header>
  <h1>⚙️ Artisan Runner &mdash; <?= htmlspecialchars(BASE_DIR) ?></h1>
  <a href="?logout=1">Logout</a>
</header>

<div class="container">

  <div class="warning">
    ⚠️ <strong>Security reminder:</strong> Delete <code>public/artisan-runner.php</code> from the server when you are done.
  </div>

  <form class="custom-form" method="POST">
    <input type="text" name="cmd"
           placeholder="e.g.  migrate --force   or   route:list   or   about"
           value="<?= htmlspecialchars($_POST['cmd'] ?? '') ?>"
           autofocus>
    <button type="submit" class="btn-run">▶ Run</button>
  </form>

  <?php if ($commandRan !== ''): ?>
  <div class="output-box">
    <div class="cmd-label">$ php artisan <?= htmlspecialchars($commandRan) ?></div>
    <?php if ($execError): ?>
      <pre class="err"><?= htmlspecialchars($execError) ?></pre>
    <?php else: ?>
      <pre><?= htmlspecialchars($output) ?></pre>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <div class="groups">
    <?php foreach ($groups as $groupName => $commands): ?>
    <div class="group">
      <h3><?= htmlspecialchars($groupName) ?></h3>
      <?php foreach ($commands as $label => $cmd): ?>
      <form method="POST">
        <input type="hidden" name="cmd" value="<?= htmlspecialchars($cmd) ?>">
        <button type="submit" class="cmd-btn"><?= htmlspecialchars($label) ?></button>
      </form>
      <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
  </div>

  <div class="footer">
    PHP <?= PHP_VERSION ?> &bull; <?= htmlspecialchars(BASE_DIR) ?> &bull; <strong>Delete this file when done.</strong>
  </div>

</div>

<?php endif; ?>
</body>
</html>
