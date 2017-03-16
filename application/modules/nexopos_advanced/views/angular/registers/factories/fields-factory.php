tendooApp.factory( 'registersFields', [ 'sharedOptions', function( sharedOptions ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Caisse Name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Statut', 'nexopos_advanced' );?>',
        model   :   'status',
        options :   options.status
    },{
        type    :   'dropdown_multiselect',
        label   :   '<?php echo __( 'Utilisateurs authorisés', 'nexopos_advanced' );?>',
        model   :   'authorized_users',
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
        desc    :   '<?php echo _s( 'Fournir plus de détails sur la caisse.', 'nexopos_advanced' );?>'
    }]
}]);
