var categoriesEdit          =   function(
    categoriesEditTextDomain,
    $scope,
    $http,
    $route,
    categoriesFields,
    categoriesResource,
    $location,
    sharedValidate,
    sharedRawToOptions,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer une catégorie', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   categoriesEditTextDomain;
    $scope.fields           =   categoriesFields;
    $scope.item             =   {};
    $scope.validate         =   new sharedValidate();

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    categoriesResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    },function( entry ){
        $scope.submitDisabled   =   false;
        $scope.item             =   entry;
    },function(){
        $location.path( '/nexopos/error/404' )
    })

    // Setting options for ref_parent select
    categoriesResource.get({
            exclude     :   $route.current.params.id
        },
        function(data){
            console.log( data.entries );
            $scope.fields[1].options = sharedRawToOptions( data.entries, 'id', 'name');
        }
    );

    //Submitting Form

    $scope.submit       =   function(){
        $scope.item.author              =   <?= User::id()?>;
        $scope.item.date_modification   =   sharedMoment.now();

        if($scope.item.ref_parent == null){
            $scope.item.ref_parent = 0;
        }

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }
        $scope.submitDisabled       =   true;

        categoriesResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                if( $location.search().fallback ) {
                    $location.url( $location.search().fallback );
                } else {
                    $location.url( '/categories?notice=done' );
                }
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

categoriesEdit.$inject    =   [
    'categoriesEditTextDomain',
    '$scope',
    '$http',
    '$route',
    'categoriesFields',
    'categoriesResource',
    '$location',
    'sharedValidate',
    'sharedRawToOptions',
    'sharedDocumentTitle',
    'sharedMoment'
];

tendooApp.controller( 'categoriesEdit', categoriesEdit );
