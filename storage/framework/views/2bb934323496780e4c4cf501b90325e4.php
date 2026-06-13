<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginaled105bf70c3e22a88a2552d72e27fae5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled105bf70c3e22a88a2552d72e27fae5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.danger-alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('danger-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled105bf70c3e22a88a2552d72e27fae5)): ?>
<?php $attributes = $__attributesOriginaled105bf70c3e22a88a2552d72e27fae5; ?>
<?php unset($__attributesOriginaled105bf70c3e22a88a2552d72e27fae5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled105bf70c3e22a88a2552d72e27fae5)): ?>
<?php $component = $__componentOriginaled105bf70c3e22a88a2552d72e27fae5; ?>
<?php unset($__componentOriginaled105bf70c3e22a88a2552d72e27fae5); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginale9af99bfa2d53af14a65b48d2181bd41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale9af99bfa2d53af14a65b48d2181bd41 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.success-alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('success-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale9af99bfa2d53af14a65b48d2181bd41)): ?>
<?php $attributes = $__attributesOriginale9af99bfa2d53af14a65b48d2181bd41; ?>
<?php unset($__attributesOriginale9af99bfa2d53af14a65b48d2181bd41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale9af99bfa2d53af14a65b48d2181bd41)): ?>
<?php $component = $__componentOriginale9af99bfa2d53af14a65b48d2181bd41; ?>
<?php unset($__componentOriginale9af99bfa2d53af14a65b48d2181bd41); ?>
<?php endif; ?>

<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Payment Settings</h5>
  </div>
  <div class="card-body">

    
    <ul class="nav nav-tabs mb-3" id="payTabs" role="tablist">
      <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-methods" type="button">
          <i class="bi bi-credit-card me-1"></i> Payment Methods
        </button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-gateway" type="button">
          <i class="bi bi-key me-1"></i> Gateway Keys
        </button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-preference" type="button">
          <i class="bi bi-sliders me-1"></i> Preference
        </button>
      </li>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cpd): ?>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-coinpayments" type="button">
          <i class="bi bi-currency-bitcoin me-1"></i> CoinPayments
        </button>
      </li>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </ul>

    <div class="tab-content">

      
      <div class="tab-pane fade show active" id="tab-methods">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6 class="mb-0">Configured Payment Methods</h6>
          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addMethodModal">
            <i class="bi bi-plus-circle me-1"></i> Add New Method
          </button>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover" id="methodsTable">
            <thead class="table-dark">
              <tr>
                <th>Name</th><th>Type</th><th>Used For</th><th>Min</th><th>Max</th><th>Status</th><th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td><?php echo e($method->name); ?></td>
                <td><?php echo e(ucfirst($method->methodtype)); ?></td>
                <td><?php echo e(ucfirst($method->type)); ?></td>
                <td><?php echo e($settings->currency); ?><?php echo e(number_format($method->minimum, 2)); ?></td>
                <td><?php echo e($settings->currency); ?><?php echo e(number_format($method->maximum, 2)); ?></td>
                <td>
                  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->status == 'enabled'): ?>
                    <span class="badge bg-success">Enabled</span>
                  <?php else: ?>
                    <span class="badge bg-danger">Disabled</span>
                  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </td>
                <td>
                  <a href="<?php echo e(route('editpaymethod', $method->id)); ?>" class="btn btn-primary btn-sm me-1">
                    <i class="bi bi-pencil"></i> Edit
                  </a>
                  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->status == 'enabled'): ?>
                    <a href="<?php echo e(route('togglestatus', $method->id)); ?>" class="btn btn-warning btn-sm me-1">
                      <i class="bi bi-toggle-off"></i> Disable
                    </a>
                  <?php else: ?>
                    <a href="<?php echo e(route('togglestatus', $method->id)); ?>" class="btn btn-success btn-sm me-1">
                      <i class="bi bi-toggle-on"></i> Enable
                    </a>
                  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($method->defaultpay ?? '') != 'yes'): ?>
                    <a href="<?php echo e(route('deletepaymethod', $method->id)); ?>" class="btn btn-danger btn-sm"
                      onclick="return confirm('Delete <?php echo e($method->name); ?>?')">
                      <i class="bi bi-trash"></i>
                    </a>
                  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr><td colspan="7" class="text-center text-muted">No payment methods configured yet.</td></tr>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      
      <div class="tab-pane fade" id="tab-gateway">
        <form method="POST" action="<?php echo e(route('updategateway')); ?>">
          <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

          <h6 class="border-bottom pb-2 mb-3"><i class="bi bi-stripe me-1"></i> Stripe</h6>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label">Stripe Secret Key</label>
              <input type="text" name="s_s_k" class="form-control" value="<?php echo e($settings->s_s_k); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Stripe Publishable Key</label>
              <input type="text" name="s_p_k" class="form-control" value="<?php echo e($settings->s_p_k); ?>">
            </div>
          </div>

          <h6 class="border-bottom pb-2 mb-3"><i class="bi bi-paypal me-1"></i> PayPal</h6>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label">PayPal Client ID</label>
              <input type="text" name="pp_ci" class="form-control" value="<?php echo e($settings->pp_ci); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">PayPal Client Secret</label>
              <input type="text" name="pp_cs" class="form-control" value="<?php echo e($settings->pp_cs); ?>">
            </div>
          </div>

          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paystack): ?>
          <h6 class="border-bottom pb-2 mb-3">Paystack</h6>
          <p class="text-muted small">Callback URL: <code><?php echo e($settings->site_address); ?>/dashboard/paystackcallback</code></p>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label">Public Key</label>
              <input type="text" name="paystack_public_key" class="form-control" value="<?php echo e($paystack->paystack_public_key); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Secret Key</label>
              <input type="text" name="paystack_secret_key" class="form-control" value="<?php echo e($paystack->paystack_secret_key); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Paystack Email</label>
              <input type="text" name="paystack_email" class="form-control" value="<?php echo e($paystack->paystack_email); ?>">
            </div>
          </div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($moresettings): ?>
          <h6 class="border-bottom pb-2 mb-3">Flutterwave</h6>
          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <label class="form-label">Public Key</label>
              <input type="text" name="flw_public_key" class="form-control" value="<?php echo e($moresettings->flw_public_key); ?>">
            </div>
            <div class="col-md-4">
              <label class="form-label">Secret Key</label>
              <input type="text" name="flw_secret_key" class="form-control" value="<?php echo e($moresettings->flw_secret_key); ?>">
            </div>
            <div class="col-md-4">
              <label class="form-label">Secret Hash</label>
              <input type="text" name="flw_secret_hash" class="form-control" value="<?php echo e($moresettings->flw_secret_hash); ?>">
            </div>
          </div>

          <h6 class="border-bottom pb-2 mb-3">Binance Pay</h6>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label">API Key</label>
              <input type="text" name="bnc_api_key" class="form-control" value="<?php echo e($moresettings->bnc_api_key); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Secret Key</label>
              <input type="text" name="bnc_secret_key" class="form-control" value="<?php echo e($moresettings->bnc_secret_key); ?>">
            </div>
          </div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Save Gateway Settings
          </button>
        </form>
      </div>

      
      <div class="tab-pane fade" id="tab-preference">
        <form method="POST" action="<?php echo e(route('paypreference')); ?>">
          <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Deposit Option</label>
              <select name="deposit_option" class="form-select">
                <option value="<?php echo e($settings->deposit_option ?? 'manual'); ?>" selected><?php echo e($settings->deposit_option ?? 'manual'); ?> (Current)</option>
                <option value="manual">Manual</option>
                <option value="auto">Automatic</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Withdrawal Option</label>
              <select name="withdrawal_option" class="form-select">
                <option value="<?php echo e($settings->withdrawal_option ?? 'manual'); ?>" selected><?php echo e($settings->withdrawal_option ?? 'manual'); ?> (Current)</option>
                <option value="manual">Manual</option>
                <option value="auto">Automatic</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Minimum Deposit Amount</label>
              <input type="number" name="minamt" class="form-control" value="<?php echo e($moresettings->minamt ?? ''); ?>">
              <small class="text-muted">Minimum amount a user can deposit.</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Auto USDT Merchant</label>
              <select name="merchat" class="form-select">
                <option value="<?php echo e($settings->auto_merchant_option ?? ''); ?>" selected><?php echo e($settings->auto_merchant_option ?? ''); ?> (Current)</option>
                <option value="Coinpayment">CoinPayment</option>
                <option value="Binance">Binance</option>
              </select>
              <small class="text-muted">Ensure API keys are set for the selected merchant. Website currency must be USD for Binance.</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Withdrawal Deduction</label>
              <select name="deduction_option" class="form-select">
                <option value="<?php echo e($settings->deduction_option ?? 'userRequest'); ?>" selected>
                  <?php echo e(($settings->deduction_option ?? '') == 'userRequest' ? 'Deduct on user request' : 'Deduct when admin approves'); ?> (Current)
                </option>
                <option value="userRequest">Deduct on user request</option>
                <option value="AdminApprove">Deduct when admin approves</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Credit Card Payment Provider</label>
              <select name="credit_card_provider" class="form-select">
                <option value="<?php echo e($settings->credit_card_provider ?? ''); ?>" selected><?php echo e($settings->credit_card_provider ?? ''); ?> (Current)</option>
                <option value="Paystack">Paystack</option>
                <option value="Flutterwave">Flutterwave</option>
                <option value="Stripe">Stripe</option>
              </select>
              <small class="text-muted">Ensure correct API keys are entered for the selected provider.</small>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Save Preference
              </button>
            </div>
          </div>
        </form>
      </div>

      
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cpd): ?>
      <div class="tab-pane fade" id="tab-coinpayments">
        <form method="POST" action="<?php echo e(route('updatecpd')); ?>">
          <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Merchant ID</label>
              <input type="text" name="cp_m_id" class="form-control" value="<?php echo e($cpd->cp_m_id ?? ''); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">IPN Secret</label>
              <input type="text" name="cp_ipn_secret" class="form-control" value="<?php echo e($cpd->cp_ipn_secret ?? ''); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Debug Email</label>
              <input type="email" name="cp_debug_email" class="form-control" value="<?php echo e($cpd->cp_debug_email ?? ''); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Public Key</label>
              <input type="text" name="cp_p_key" class="form-control" value="<?php echo e($cpd->cp_p_key ?? ''); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Private Key</label>
              <input type="text" name="cp_pv_key" class="form-control" value="<?php echo e($cpd->cp_pv_key ?? ''); ?>">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Save CoinPayments Settings
              </button>
            </div>
          </div>
        </form>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
  </div>
</div>


<div class="modal fade" id="addMethodModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Payment Method</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo e(route('addpaymethod')); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="row g-3">
            <div class="col-md-12">
              <label class="form-label">Method Name</label>
              <input type="text" class="form-control" name="name" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Type</label>
              <select name="methodtype" id="methodtype" class="form-select" required>
                <option value="currency">Currency / Bank</option>
                <option value="crypto">Cryptocurrency</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Used For</label>
              <select name="typefor" class="form-select" required>
                <option value="deposit">Deposit</option>
                <option value="withdrawal">Withdrawal</option>
                <option value="both">Both</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Minimum Amount</label>
              <input type="number" class="form-control" name="minimum" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Maximum Amount</label>
              <input type="number" class="form-control" name="maximum" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Charges</label>
              <input type="number" class="form-control" name="charges" value="0" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Charge Type</label>
              <select name="chargetype" class="form-select">
                <option value="percentage">Percentage (%)</option>
                <option value="fixed">Fixed (<?php echo e($settings->currency); ?>)</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Image / Logo URL (optional)</label>
              <input type="text" class="form-control" name="url">
            </div>
            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select name="status" class="form-select" required>
                <option value="enabled">Enabled</option>
                <option value="disabled">Disabled</option>
              </select>
            </div>

            
            <div id="currency-fields">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Bank Name</label>
                  <input type="text" class="form-control" name="bank">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Account Name</label>
                  <input type="text" class="form-control" name="account_name">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Account Number</label>
                  <input type="text" class="form-control" name="account_number">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Swift / Sort Code</label>
                  <input type="text" class="form-control" name="swift">
                </div>
              </div>
            </div>

            
            <div id="crypto-fields" class="d-none">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Wallet Address</label>
                  <input type="text" class="form-control" name="walletaddress">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Network Type (e.g. ERC20)</label>
                  <input type="text" class="form-control" name="wallettype">
                </div>
              <div class="col-md-6">
                  <label class="form-label">Barcode / QR Image (optional)</label>
                  <input type="file" class="form-control" name="barcode" accept="image/*">
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <label class="form-label">Note / Instructions (optional)</label>
              <input type="text" class="form-control" name="note" placeholder="e.g. Payment may take up to 24 hours">
            </div>

            <div class="col-12">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Save Method
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  $(document).ready(function () {
    $('#methodsTable').DataTable({ responsive: true });

    // Toggle currency / crypto fields in modal
    $('#methodtype').on('change', function () {
      if ($(this).val() === 'crypto') {
        $('#currency-fields').addClass('d-none');
        $('#crypto-fields').removeClass('d-none');
      } else {
        $('#currency-fields').removeClass('d-none');
        $('#crypto-fields').addClass('d-none');
      }
    });
  });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/Settings/PaymentSettings/show.blade.php ENDPATH**/ ?>