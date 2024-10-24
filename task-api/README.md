# Setup Instructions for Lumen Task Management System
1. Clone the Repository: First, clone the repository using Git.
    git clone https://github.com/tituskaswii/Technoprise-TaskAPI.git
    'cd task-api'
2. Install Composer: Make sure you have Composer installed. If you don’t have it installed, you can follow the instructions on the Composer website.
   - Install Dependencies: Install the project dependencies using Composer:
    'composer install'
3. Environment Configuration: Copy the .env.example file to create a new .env file:
    cp .env.example .env
    - Edit the .env file to set up your environment variables, such as database connection details, application key, etc.
    'nano .env'

    - You can set up the database connection like this:

    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=TechnopriseDB
    DB_USERNAME=postgres
    DB_PASSWORD=your_password

4. Run Migrations: Run the database migrations to set up the necessary tables:

    php artisan migrate

<<<<<<<<<<<<<<<<<<<<< Set up is now done: Lets run the application >>>>>>>>>>>>>>>>>>>>> 

Here’s how we can run the application to process requests and test the Lumen API endpoints:

### Step 1: Running the Lumen Application
To run the Lumen application, execute the following command in the terminal from the root of the project:

    php -S localhost:8000 -t public


This will start the Lumen development server, and we can access the API at:

    http://localhost:8000


### Step 2: API Endpoints and How to Test Them

Here are the RESTful API endpoints I created for the Task Management System and the corresponding methods for testing them using tools like Postman, cURL, or Insomnia.

---

#### 1. Create a Task
- Endpoint: `POST /api/tasks`
- URL: `http://localhost:8000/api/tasks`
- Payload Example:
  json
  {
      "title": "New Task",
      "description": "Description of the new task",
      "due_date": "2024-12-31"
  }

- Expected Response (201 Created):
  json
  {
      "id": 1,
      "title": "New Task",
      "description": "Description of the new task",
      "status": "pending",
      "due_date": "2024-12-31T00:00:00.000000Z",
      "created_at": "2024-10-24T00:00:00.000000Z",
      "updated_at": "2024-10-24T00:00:00.000000Z"
  }

---------------------------------------------------------------

#### 2. Get All Tasks (with optional filters)
- Endpoint: `GET /api/tasks`
- URL: `http://localhost:8000/api/tasks`
- Query Parameters (optional):
  - `status`: `pending` or `completed`
  - `due_date`: `2024-12-31`
  - `title`: Search for tasks by title
  - Pagination: `page=1` (for pagination)

- Example URL with filters:

  http://localhost:8000/api/tasks?status=pending&due_date=2024-12-31


- Expected Response (200 OK):
  json
  {
      "data": [
          {
              "id": 1,
              "title": "New Task",
              "description": "Description of the new task",
              "status": "pending",
              "due_date": "2024-12-31T00:00:00.000000Z",
              "created_at": "2024-10-24T00:00:00.000000Z",
              "updated_at": "2024-10-24T00:00:00.000000Z"
          }
      ],
      "links": {
          "first": "http://localhost:8000/api/tasks?page=1",
          "last": "http://localhost:8000/api/tasks?page=1",
          "prev": null,
          "next": null
      },
      "meta": {
          "current_page": 1,
          "from": 1,
          "last_page": 1,
          "path": "http://localhost:8000/api/tasks",
          "per_page": 10,
          "to": 1,
          "total": 1
      }
  }


---------------------------------------------------------------

#### 3. Get a Specific Task
- Endpoint: `GET /api/tasks/{id}`
- URL: `http://localhost:8000/api/tasks/1`

- Expected Response (200 OK):
  json
  {
      "id": 1,
      "title": "New Task",
      "description": "Description of the new task",
      "status": "pending",
      "due_date": "2024-12-31T00:00:00.000000Z",
      "created_at": "2024-10-24T00:00:00.000000Z",
      "updated_at": "2024-10-24T00:00:00.000000Z"
  }


---------------------------------------------------------------

#### 4. Update a Task
- Endpoint: `PUT /api/tasks/{id}`
- URL: `http://localhost:8000/api/tasks/1`
- Payload Example:
  json
  {
      "title": "Updated Task",
      "description": "Updated task description",
      "status": "completed",
      "due_date": "2024-12-31"
  }

- Expected Response (200 OK):
  json
  {
      "id": 1,
      "title": "Updated Task",
      "description": "Updated task description",
      "status": "completed",
      "due_date": "2024-12-31T00:00:00.000000Z",
      "created_at": "2024-10-24T00:00:00.000000Z",
      "updated_at": "2024-10-24T00:00:00.000000Z"
  }


--------------------------------------------------------------

#### 5. Delete a Task
- Endpoint: `DELETE /api/tasks/{id}`
- URL: `http://localhost:8000/api/tasks/1`

- Expected Response (204 No Content):
  No response body, just a status code of 204 indicating the task was deleted successfully.

---

### Step 3: Testing API Endpoints with Tools

#### 1. Using Postman

- Open Postman and create a new request for each endpoint:
  1. POST for creating a task
  2. GET for fetching tasks
  3. PUT for updating a task
  4. DELETE for deleting a task
- Set the request type (GET, POST, PUT, DELETE).
- Set the URL (e.g., `http://localhost:8000/api/tasks`).
- For POST and PUT requests, provide the required JSON body in the "Body" tab and set it to "raw" and "JSON" format.
- Click Send to make the request and view the response in the "Body" section.

#### 2. Using cURL

You can also test the API using `cURL` from the terminal:

- Create a task (POST request):

  curl -X POST http://localhost:8000/api/tasks \
  -H "Content-Type: application/json" \
  -d '{"title": "Task 1", "description": "First Task", "due_date": "2024-12-31"}'


- Get all tasks (GET request):

  curl -X GET http://localhost:8000/api/tasks


- Get a specific task (GET request):

  curl -X GET http://localhost:8000/api/tasks/1


- Update a task (PUT request):

  curl -X PUT http://localhost:8000/api/tasks/1 \
  -H "Content-Type: application/json" \
  -d '{"title": "Updated Task", "status": "completed", "due_date": "2024-12-31"}'


- Delete a task (DELETE request):

  curl -X DELETE http://localhost:8000/api/tasks/1
