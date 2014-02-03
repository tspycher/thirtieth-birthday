function GiftController($scope, $http) {
    $http.get('/api/gifts.json').
        success(function(data) {
            $scope.gifts = data.gift;
        });
}


function ParticipantController($scope, $http) {


    $scope.doPartipate = function () {
        /**$scope.message = "Vielen Dank für die Teilname"+$scope.name ; */

        $http.post('/api/participants.json', { 'name':$scope.name },{'Content-Type': 'application/json'}).success(function(data) {
            $scope.message = "Super, ich freue mich auf dich "+$scope.name;
        }).error(function(data) {
                $scope.message = "Sorry, ich konnte dich nicht registrieren";
            });

    }
}