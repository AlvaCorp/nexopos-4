var couponsMain          =   function( couponsTextDomain, $scope, $http, couponsResource, $location, validate, table, couponsTable, paginationFactory, sharedTableActions, sharedAlert,sharedEntryActions, sharedDocumentTitle  ) {

    sharedDocumentTitle.set( '<?php echo _s( 'Liste des coupons', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   couponsTextDomain;
    $scope.validate         =   validate;
    $scope.table            =   table;
    $scope.table.columns    =   couponsTable.columns;
    $scope.table.actions    =   sharedTableActions;


    /** Adjust Entry actions **/
    _.each( sharedEntryActions, function( value, key ) {
        if( value.namespace == 'edit' ) {
            sharedEntryActions[ key ].path      =    '/coupons/edit/';
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
        couponsResource.get( params,function( data ) {
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
        couponsResource.delete( params, function( data ) {
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

couponsMain.$inject    =   [ 
    'couponsTextDomain', 
    '$scope', 
    '$http', 
    'couponsResource', 
    '$location', 
    'validate', 
    'table', 
    'couponsTable', 
    'paginationFactory', 
    'sharedTableActions', 
    'sharedAlert',
    'sharedEntryActions', 
    'sharedDocumentTitle' 
];

tendooApp.controller( 'couponsMain', couponsMain );
