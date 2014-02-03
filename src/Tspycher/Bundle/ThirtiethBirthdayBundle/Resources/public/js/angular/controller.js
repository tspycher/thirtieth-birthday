function Test($scope, $http) {
    $http.get('/api/gifts.json').
        success(function(data) {
            $scope.gifts = data.gift;
        });
}