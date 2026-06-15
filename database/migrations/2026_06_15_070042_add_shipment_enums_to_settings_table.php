<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('shipment_statuses')->nullable()->after('locations');
            $table->text('freight_types')->nullable()->after('shipment_statuses');
        });

        // Seed defaults into the existing row
        DB::table('settings')->where('id', 1)->update([
            'shipment_statuses' => json_encode([
                'Order Confirmed',
                'Picked by Courier',
                'On The Way',
                'Custom Hold',
                'Delivered',
            ]),
            'freight_types' => json_encode([
                'Road Transport',
                'Air Freight',
                'Sea Freight',
                'Rail Transport',
                'Multimodal Transport',
            ]),
        ]);
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['shipment_statuses', 'freight_types']);
        });
    }
};
