function ParticipantController($scope, $http) {
    $scope.register = {id_participant: 0, id_people: 0};

    $http.get('/api/gifts.json').
        success(function(data) {
            $scope.gifts = data.gift;
        });

    $scope.getParicipantCount = function () {
        $http.get('/api/participants/count.json').
            success(function(data) {
                $scope.seatsCount = data.seats;
                $scope.participants = data.participants;
            }).error(function(data) {
                $scope.seatsCount = 0;
                $scope.participants = 0;
            });
    }

    $scope.getParicipantCount();

    $scope.doLoadPartipate = function () {
        $http.get('/api/participants/'+$scope.login.token+'.json').
            success(function(data) {
                $scope.loadToken(data);
                /**this.register.name = "blubb";**/
                $scope.register = {
                    name: data.people.name,
                    numPlaces: data.number_of_seats,
                    email: data.people.email,
                    id_participant: data.id,
                    id_people: data.people.id
                };

            }).error(function(data) {
                $scope.seatsCount = 0;
                $scope.participants = 0;
            });
    }

    $scope.loadToken = function (data) {
        $scope.message = "Super, ich freue mich auf dich ";
        $scope.getParicipantCount();
        $scope.token = data.code;
    }

    $scope.doPartipate = function () {
        /**$scope.message = "Vielen Dank für die Teilname"+$scope.name ; */

        $http.post('/api/participants.json', $scope.register, {'Content-Type': 'application/json'}).success(function(data) {
            $scope.loadToken(data);
        }).error(function(data) {
                $scope.message = "Sorry, ich konnte dich nicht registrieren";
            });

    }


}