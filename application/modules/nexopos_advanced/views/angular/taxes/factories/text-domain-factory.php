tendooApp.factory( 'taxesTextDomain', function(){
    return  {
        title   :   '<?php echo __( 'Créer une taxe', 'nexopos_advanced' );?>',
        return  :   '<?php echo __( 'Revenir vers la liste', 'nexopos_advanced' );?>',
        returnLink  :   '<?php echo site_url([ 'dashboard', 'nexopos', 'categories' ] );?>',
        itemTitle  :   '<?php echo __( 'nouvelle taxe', 'nexopos_advanced' );?>',
        saveBtnText :   '<?php echo __( 'Sauvegarder', 'nexopos_advanced' );?>',
        fieldsTitle :   '<?php echo __( 'Options', 'nexopos_advanced' );?>',
        addNewLink  :   '<?php echo site_url( [ 'dashboard', 'nexopos', 'taxes', 'add' ] );?>',
        listTitle   :   '<?php echo __( 'Liste des taxes', 'nexopos_advanced' );?>',
        addNew  :   '<?php echo __( 'Nouvelle taxe', 'nexopos_advanced' );?>'
    }
});
