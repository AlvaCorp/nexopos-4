var categories          =   function( categoriesTextDomain, $scope, $http, categoriesFields, categoriesResource, $location, validate ) {

    $scope.textDomain       =   categoriesTextDomain;
    $scope.fields           =   categoriesFields;
    $scope.item             =   {};
    $scope.validate         =   validate;

   $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        categoriesResource.save(
            $scope.item,
            function(){
                $location.url( '/categories?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

categories.$inject    =   [ 'categoriesTextDomain', '$scope', '$http', 'categoriesFields', 'categoriesResource', '$location', 'validate' ];
tendooApp.controller( 'categories', categories );
