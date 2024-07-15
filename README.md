API Documentation

This document provides an overview of the available API endpoints for your Laravel application. The API uses JSON for data exchange and follows RESTful conventions.

Authentication

The API uses JWT (JSON Web Token) based authentication for protected routes. You'll need to obtain a token through the login endpoint (/register and /login) before accessing protected resources.

Open Endpoints

POST /register - Registers a new user.
Request Body:
name (string, required)
email (string, required, email format, unique)
password (string, required, confirmed)
Response:
status (boolean) - indicates success or failure
message (string) - status message
data (array) - empty on success
POST /login - Logs in a user and generates a JWT token.
Request Body:
email (string, required, email format)
password (string, required)
Response:
status (boolean) - indicates success or failure
message (string) - status message
token (string) - JWT token on success
expires_in (integer) - token expiration time in seconds (minutes here)
Protected Endpoints (require JWT authorization)

GET /get_user - Retrieves the authenticated user's profile data.
GET /refresh-token - Refreshes the current JWT token.
GET /logout - Logs out the authenticated user.
Todos (require JWT authorization)

GET /todos - Retrieves a list of all TODOs.
GET /todos/{id} - Retrieves a specific TODO by its ID.
Path Parameter:
{id} (integer) - The ID of the TODO to retrieve.
POST /todos - Creates a new TODO.
Request Body:
title (string, required) - Title of the TODO.
completed (boolean, optional) - Whether the TODO is completed (defaults to false).
PUT /todos/{id} - Updates a specific TODO.
Path Parameter:
{id} (integer) - The ID of the TODO to update.
Request Body:
title (string, optional) - Updated title of the TODO.
completed (boolean, optional) - Updated completion status of the TODO.
DELETE /todos/{id} - Deletes a specific TODO.
Path Parameter:
{id} (integer) - The ID of the TODO to delete.
