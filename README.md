# API Documentation

This document provides a comprehensive overview of the available API endpoints for your Laravel application. The API adheres to RESTful conventions and utilizes JSON for data exchange.

Authentication
The API leverages JWT (JSON Web Token) based authentication for protected routes. To access these resources, you'll need to acquire a token through the login endpoint (/login).

Open Endpoints
POST /register

Registers a new user.
Request Body:
name (string, required): User's name.
email (string, required, email format, unique): User's email address.
password (string, required, confirmed): User's password.
Response:
status (boolean): Indicates success or failure.
message (string): Status message.
data (array): Empty on success.
POST /login

Logs in a user and generates a JWT token.
Request Body:
email (string, required, email format): User's email address.
password (string, required): User's password.
Response:
status (boolean): Indicates success or failure.
message (string): Status message.
token (string): JWT token on success.
expires_in (integer): Token expiration time in seconds (minutes mentioned previously).
Protected Endpoints (Require JWT Authorization)
These endpoints require a valid JWT token for authorization.

GET /get_user

Retrieves the authenticated user's profile data.
GET /refresh-token

Refreshes the current JWT token.
GET /logout

Logs out the authenticated user.
Todos (Require JWT Authorization)
These endpoints manage TODO items within the application.

GET /todos

Retrieves a list of all TODOs.
GET /todos/{id}

Retrieves a specific TODO by its ID.
Path Parameter:
{id} (integer): The ID of the TODO to retrieve.
POST /todos

Creates a new TODO.
Request Body:
title (string, required): Title of the TODO.
completed (boolean, optional): Whether the TODO is completed (defaults to false).
PUT /todos/{id}

Updates a specific TODO.
Path Parameter:
{id} (integer): The ID of the TODO to update.
Request Body:
title (string, optional): Updated title of the TODO.
completed (boolean, optional): Updated completion status of the TODO.
DELETE /todos/{id}

Deletes a specific TODO.
Path Parameter:
{id} (integer): The ID of the TODO to delete.
Error Codes
The API employs different HTTP status codes to communicate errors. Here's a general guideline:

200 OK: Successful request.
201 Created: Resource created successfully (e.g., creating a new TODO).
400 Bad Request: Invalid request data or missing required fields.
401 Unauthorized: Access denied due to missing or invalid JWT token.
403 Forbidden: Insufficient permissions to access the resource.
404 Not Found: The requested resource cannot be found (e.g., a TODO with a specific ID).
500 Internal Server Error: Unexpected server error
