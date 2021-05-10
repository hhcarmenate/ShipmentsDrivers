# ShipmentsDrivers App Guide
Platform Science Exercise 

Steps
- Download the master branch
- Open the terminal(cmd) and go to Project Path
- Run "docker-compose up --build" (You must have docker installed on your computer)
- Login into docker container named platform_science_app and run "php artisan migrate"
- Go to localhost:90 

    ![image](https://user-images.githubusercontent.com/16532763/117706521-69eb2f00-b19b-11eb-838b-e129a0e3debd.png)
    
- Go to register link and create a new user.

    ![image](https://user-images.githubusercontent.com/16532763/117706676-9a32cd80-b19b-11eb-8d4c-9e65c34e53d9.png)
    
- Once registered, the application redirects you to the dashboard.

    ![image](https://user-images.githubusercontent.com/16532763/117707308-6b692700-b19c-11eb-8841-0e8e42824158.png)

- In the new screen upload Shipments and Drivers list on each button respectively. 

    ![image](https://user-images.githubusercontent.com/16532763/117707248-57bdc080-b19c-11eb-8807-c95cd7234e01.png)

- The uploaded files must meet the following format.
  
  - Shipments
  
    ![image](https://user-images.githubusercontent.com/16532763/117707725-e599ab80-b19c-11eb-81eb-9184aaaced89.png)
    
  - Drivers
    
    ![image](https://user-images.githubusercontent.com/16532763/117707815-06fa9780-b19d-11eb-9ec3-6a7a3b5a2cb6.png)

    
- Once uploaded you will see the following screen.
  
  ![image](https://user-images.githubusercontent.com/16532763/117708040-53de6e00-b19d-11eb-86e6-dfcb3ba4b826.png)

- Click in "Make Assignment" button to make association base on the Suitable Score.
  
  ![image](https://user-images.githubusercontent.com/16532763/117708424-c94a3e80-b19d-11eb-90e7-4329611169d8.png)


## Important Classes.

- Created all models needed base on Problem Description.

  app/Models/Driver.php  
  app/Models/ShipmentDestination.php  
  app/Models/ShipmentDestinationsDrivers.php  
  app/Models/ThirdPartyCompany.php  
  app/Models/User.php  
  
- Created Controllers for web and api request.

  app/Http/Controllers/Shipments/ShipmentsByDatesApiController.php  
  app/Http/Controllers/Shipments/ShipmentsByDatesController.php  
  
- Api response class to handle SPA respond

  app/Http/Support/Response/ApiResponse.php  
  
- Form Request Classes to validate request.

  app/Http/Support/Response/ApiResponse.php  
  app/Http/Requests/MakeAssignmentRequest.php  
  
- Classes to check and Transform data from excel to arrays.

  app/Http/Support/Shipments/CheckFile/CheckFile.php (abstract)  
  app/Http/Support/Shipments/CheckFile/CheckFileDrivers.php (concrete)  
  app/Http/Support/Shipments/CheckFile/CheckFileShipments.php (concrete)  
  
- Classes that implement Defined algorithm.

  app/Http/Support/Shipments/ShipmentDestinationAssign.php  
  app/Http/Support/Shipments/DriversData.php  
  app/Http/Support/Shipments/ShipmentDestinationData.php  
  app/Http/Support/Shipments/CalculateSuitableScore.php  
  
- Unit Test for solution.

  tests/Unit/DriversData/DriversDataTest.php  
  tests/Unit/CalculateSuitableScore/CalculateSuitableScoreTest.php  
  tests/Unit/ShipmentDestinationData/ShipmentDestinationDataTest.php  
  
## Vuejs Components and pages.

- Components.

  resources/js/Components/AssignmentsTable.vue  
  resources/js/Components/ShipmentTable.vue  
  resources/js/Components/ShipmentsDates.vue  
  resources/js/Components/PlatformScienceCardLogo.vue  
  resources/js/Components/DriversTable.vue  
  resources/js/Components/AssignmentsTable.vue  
  
- Pages.

  resources/js/Pages/Shipments/Assigned.vue  
  resources/js/Pages/Shipments/Create.vue  
  
  
  
  
