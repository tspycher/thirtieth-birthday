function ParticipantController($scope, $http) {
    $scope.register = {id_participant: 0, id_people: 0};

    $http.get('/api/gifts.json').
        success(function(data) {
            $scope.gifts = data.gift;
        });

    $scope.loadDetails = function (url) {
        $http.get(url).
            success(function(data) {
                $scope.giftDetails = data;
            }).error(function(data) {
                $scope.giftDetails = "Sorry konnte Details nicht laden";
            });
    }

    $scope.getParicipantCount = function () {
        $http.get('/api/participantcount.json').
            success(function(data) {
                $scope.seatsCount = data.seats;
                $scope.participants = data.participants;
            }).error(function(data) {
                $scope.seatsCount = 0;
                $scope.participants = 0;
            });
    }

    $scope.getParicipantCount();

    /**
     * Load Prticipiants
     */
    $scope.doLoadPartipate = function () {
        $http.get('/api/participants/'+$scope.login.token+'.json').
            success(function(data) {
                $scope.getParicipantCount();
                /**this.register.name = "blubb";**/
                $scope.register = {
                    name: data.people.name,
                    numPlaces: data.number_of_seats,
                    email: data.people.email,
                    giftAmount: data.people.donate.amount,
                    id_participant: data.id,
                    id_people: data.people.id,
                    id_gift: data.people.donate.gift.id
                };

            }).error(function(data) {
                $scope.seatsCount = 0;
                $scope.participants = 0;
            });
    }

    $scope.loadToken = function (data) {
        this.setSuccess("Super, ich freue mich auf dich");
        $scope.getParicipantCount();
        $scope.token = data.code;
    }

    $scope.setSuccess = function (text) {
        $scope.message = text;
        $scope.messageType = "success";
    }
    $scope.setDanger = function (text) {
        $scope.message = text;
        $scope.messageType = "danger";
    }

    $scope.doPartipate = function () {
        /**$scope.message = "Vielen Dank für die Teilname"+$scope.name ; */

        $http.post('/api/participants.json', $scope.register, {'Content-Type': 'application/json'}).success(function(data) {
            $scope.loadToken(data);
            $scope.register = {}
        }).error(function(data) {
                this.setDanger("Sorry, ich konnte dich nicht registrieren");
            });

    }


}