function GiftController($scope, $http) {
    $http.get('/api/gifts.json').
        success(function(data) {
            $scope.gifts = data.gift;
        });
}


function ParticipantController($scope, $http) {


    $scope.doPartipate = function () {
        /**$scope.message = "Vielen Dank für die Teilname"; */
        $http.post('/api/participants.json').success(function(data) {
            $scope.message = "Super, ich freue mich auf dich";
        }).error(function(data) {
                $scope.message = "Sorry, ich konnte dich nicht registrieren";
            });

    }
}