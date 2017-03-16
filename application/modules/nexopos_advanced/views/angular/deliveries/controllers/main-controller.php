var deliveriesMain          =   function( deliveriesTextDomain, $scope, $http, deliveriesResource, $location, sharedValidate, sharedTable, deliveriesTable, paginationFactory, sharedTableActions, sharedAlert, sharedEntryActions, sharedDocumentTitle ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des livraisons', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   deliveriesTextDomain;
    $scope.validate         =   new sharedValidate();
    $scope.table            =   new sharedTable();
    $scope.table.columns    =   deliveriesTable.columns;

    /** Adjust Entry actions **/
    _.each( sharedEntryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            sharedEntryActions[ key ].path      =    '/deliveries/edit/';
        }
    });

    $scope.table.entryActions   =   sharedEntryActions;
    $scope.table.actions        =   sharedTableActions

    /**
     *  Table Get
     *  @param object query object
     *  @return void
    **/

    $scope.table.get        =   function( params ){
        deliveriesResource.get( params,function( data ) {
            $scope.table.entries        =   data.entries;
            $scope.table.pages          =   Math.ceil( data.num_rows / $scope.table.limit );
        });
    }

    /**
     *  Table Delete
     *  @param object query
     *  @return void
    **/

    $scope.table.delete     =   function( params ){
        deliveriesResource.delete( params, function( data ) {
            $scope.table.get();
        },function(){
            sharedAlert.warning( '<?php echo _s(
                'Une erreur s\'est produite durant l\'operation',
                'nexopos_advanced'
            );?>' );
        });
    }

    // Get Results
    $scope.table.limit      =   10;
    $scope.table.getPage(0);
}

deliveriesMain.$inject    =   [
    'deliveriesTextDomain',
    '$scope',
    '$http',
    'deliveriesResource',
    '$location',
    'sharedValidate',
    'sharedTable',
    'deliveriesTable',
    'paginationFactory',
    'sharedTableActions',
    'sharedAlert',
    'sharedEntryActions',
    'sharedDocumentTitle'
];

tendooApp.controller( 'deliveriesMain', deliveriesMain );
