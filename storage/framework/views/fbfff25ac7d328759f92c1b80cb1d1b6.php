<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin:0; padding:0;">
    <div style="max-width:600px; margin:0 auto; padding:20px;">

        
        <div style="background-color:<?php echo e($bgColor); ?>; color:white; padding:15px; text-align:center;">
            <h2 style="margin:0;">Shipment Status Update</h2>
        </div>

        
        <div style="padding:20px; background-color:#f9f9f9; border:1px solid #ddd;">
            <p>Dear <?php echo e($shipment->name); ?>,</p>
            <p>Your shipment status has been updated:</p>

            <p style="text-align:center;">
                <span style="display:inline-block; padding:6px 12px; background-color:<?php echo e($bgColor); ?>; color:white; border-radius:12px; font-weight:bold;">
                    <?php echo e($status); ?>

                </span>
            </p>

            <div style="margin:20px 0; padding:15px; background-color:#f0f9ff; border-left:4px solid <?php echo e($bgColor); ?>;">
                <p><strong>Update Details:</strong></p>
                <p><?php echo e($comment); ?></p>
            </div>

            <p>Tracking Number: <strong><?php echo e($shipment->trackingnumber); ?></strong></p>

            <p>You can track your shipment anytime by clicking the button below:</p>
            <p style="text-align:center;">
                <a href="<?php echo e($settings->site_address); ?>track?tracking=<?php echo e($shipment->trackingnumber); ?>"
                   style="display:inline-block; padding:10px 20px; background-color:<?php echo e($bgColor); ?>; color:white; text-decoration:none; border-radius:4px;">
                   Track Your Package
                </a>
            </p>

            <p>Thank you for choosing <?php echo e($settings->site_name); ?> for your shipping needs.</p>
        </div>

        
        <div style="padding:10px; text-align:center; font-size:12px; color:#666;">
            <p>&copy; <?php echo e(date('Y')); ?> <?php echo e($settings->site_name); ?>. All rights reserved.</p>
            <p><?php echo e($settings->site_address); ?> | <?php echo e($settings->contact_email); ?></p>
        </div>

    </div>
</body>
</html>
<?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/emails/shipment_status_update.blade.php ENDPATH**/ ?>