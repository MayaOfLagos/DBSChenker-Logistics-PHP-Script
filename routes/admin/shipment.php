<?php

use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

// Shipment Management Routes
Route::middleware(['isadmin', '2fa'])->prefix('admin')->group(function () {
    Route::controller(ShipmentController::class)->group(function () {
        Route::get('shipments', 'listShipments')->name('admin.shipments');

        Route::get('shipment/deposits', 'shipmentDeposits')->name('admin.shipment.deposits');

        Route::get('shipments/create', function () {
            $settings = \App\Models\Settings::where('id', '1')->first();
            return view('admin.create-shipment', [
                'settings'         => $settings,
                'title'            => 'Create New Shipment',
                'shipmentStatuses' => $settings?->getShipmentStatusesWithDefault() ?? [],
                'freightTypes'     => $settings?->getFreightTypesWithDefault() ?? [],
            ]);
        })->name('admin.shipments.create');

        Route::post('shipments/store', 'storeShipment')->name('admin.shipments.store');

        Route::get('shipments/view/{id}', 'viewShipment')->name('admin.shipments.view');

        Route::get('shipments/edit/{id}', function ($id) {
            $shipment = \App\Models\User::findOrFail($id);
            $settings = \App\Models\Settings::where('id', '1')->first();
            return view('admin.edit-shipment', [
                'shipment'         => $shipment,
                'settings'         => $settings,
                'title'            => 'Edit Shipment',
                'shipmentStatuses' => $settings?->getShipmentStatusesWithDefault() ?? [],
                'freightTypes'     => $settings?->getFreightTypesWithDefault() ?? [],
            ]);
        })->name('admin.shipments.edit');

        Route::post('shipments/update', 'updateShipment')->name('admin.shipments.update');

        Route::get('shipments/update-status/{id}', 'showUpdateStatusForm')->name('admin.shipments.update-status-form');
        Route::get('shipment/shipment/delete/{id}', 'deleteShipment')->name('admin.delete.shipment');

        Route::post('shipments/update-status', 'updateShipmentStatus')->name('admin.shipments.update-status');

        Route::get('shipments/print/{id}', function ($id) {
            $shipment = \App\Models\User::findOrFail($id);
            $settings = \App\Models\Settings::where('id', '1')->first();
            return view('admin.print-shipment', [
                'shipment' => $shipment,
                'settings' => $settings,
                'title' => 'Print Shipment Invoice'
            ]);
        })->name('admin.shipments.print');

        Route::get('shipment/deposits/process/{id}', 'processDeposit')->name('admin.process.deposit');
        Route::get('shipment/deposits/view/{id}', 'viewDeposit')->name('admin.view.deposit');
        Route::get('shipment/deposits/viewimage/{id}', 'viewDepositImage')->name('admin.view.depositimage');
        Route::get('shipment/deposits/delete/{id}', 'deleteDeposit')->name('admin.delete.deposit');
        Route::get('shipment/deposits/export/{format}', 'exportDeposits')->name('admin.export.deposits');
    });
});
