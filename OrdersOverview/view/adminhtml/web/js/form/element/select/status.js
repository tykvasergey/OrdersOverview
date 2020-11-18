define([
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select',
    'Magento_Ui/js/modal/modal'
], function (_, uiRegistry, select, modal) {
    'use strict';
    return select.extend({

        onUpdate: function (value) {
            uiRegistry.get('index = delivery_comment').initialValue = '';
            uiRegistry.get('index = delivery_comment').reset();

            return this._super();
        },
    });
});
