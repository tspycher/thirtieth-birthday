var myApp = angular.module('myApp', ['ngSanitize']);



function ParticipantController($scope, $http) {

    $scope.register = {id_participant: 0, id_people: 0};
    $scope.edit = false;
    $scope.newTron = false;
    $scope.accountInfo = null;
    $scope.token = null;

    $scope.loadGifts = function () {
        $http.get('/api/gifts.json').
            success(function(data) {
                $scope.gifts = data.gift;
            });
    }

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

    $scope.editmode = function(enable) {
        if (enable) {
            $scope.editButtonLabel = "Ändern";
            $scope.edit = true;
        } else {
            $scope.editButtonLabel = "Anmelden";
            $scope.edit = false;
        }

    }

    $scope.setAccountInfo = function () {
        if ($scope.register.id_gift >= 1) {
            $scope.accountInfo = true;
        } else {
            $scope.accountInfo = false;
        }
    }

    /**
     * Load Prticipiants
     */
    $scope.doLoadPartipate = function () {
        $http.get('/api/participants/'+$scope.login.token+'.json').
            success(function(data) {
                $scope.editmode(true);
                $scope.getParicipantCount();
                $scope.token = $scope.login.token;
                console.log($scope.token);
                /**this.register.name = "blubb";**/
                $scope.register = {
                    name: data.people.name,
                    numPlaces: data.number_of_seats,
                    email: data.people.email,
                    id_participant: data.id,
                    id_people: data.people.id
                };

                if(data.people.donate) {
                    $scope.register.id_gift = data.people.donate.gift.id;
                    $scope.register.giftAmount = data.people.donate.amount;
                } else {
                    $scope.register.id_gift = 0;
                }
                $scope.setAccountInfo();


            }).error(function(data) {
                $scope.seatsCount = 0;
                $scope.participants = 0;
            });
    }

    $scope.loadToken = function (data) {
        console.log(data);
        $scope.token = data.code;
        $scope.getParicipantCount();
        $scope.setAccountInfo();
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
        if(!$scope.participate.$valid) {
            $scope.setDanger("Bitte überprüfe die Felder in der Anmeldung");
            return;
        }

        $http.post('/api/participants.json', $scope.register, {'Content-Type': 'application/json'}).success(function(data) {
            if(!$scope.edit) {
                $scope.newTron = true;

                $scope.loadToken(data);
                $scope.setSuccess("Super, ich freue mich auf dich/euch!");
            } else {
                $scope.setSuccess("Deine Änderungen sind gespeichert");
            }
            $scope.setAccountInfo();

            $scope.register = {}
            $scope.loadGifts();

        }).error(function(data) {
                $scope.setDanger("Sorry, ich konnte dich nicht registrieren");
            });

    }

    $scope.gotoCertificate = function () {
        window.location = '/certificate/'+$scope.token;
        //console.log($scope.token);
    }
    $scope.getParicipantCount();
    $scope.loadGifts();
    $scope.editmode(false);

}