# Product Dashboard Backend

This is the backend for the **Product Dashboard**, built with **Laravel**.  
It uses **MySQL** for the database. Originally it included **Vite** for asset bundling, but for backend-only usage Vite is optional.

## Prerequisites

Before you begin, make sure you have installed:
- [Docker](https://www.docker.com/products/docker-desktop/)  
- [Docker Compose](https://docs.docker.com/compose/install/)

 You do not need PHP, Composer, or Node.js installed locally because this project is fully containerized.

## Getting Started with Docker

### Build and Start the Containers

Open your terminal in the root of the project and run:

```bash
docker-compose up -d --build