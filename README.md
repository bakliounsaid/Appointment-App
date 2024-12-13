# Setting Up Your Laravel Project with Docker and Sail

Follow these steps to get your Laravel project up and running with Docker and Sail.

---

### 1. Clone the Repository
- Clone the project repository to your local machine.

### 2. Configure Environment Variables
- Copy the `.env.example` file and rename it to `.env`. Update any necessary environment variables as required for your setup.

### 3. Install Docker Desktop (if not already installed)
- **Download and Install Docker Desktop**: Follow Docker’s [official installation guide](https://docs.docker.com/get-docker/) for your operating system.
- **Enable WSL 2** (Windows only): Make sure WSL 2 is installed and set as the default for Docker.
- **Install Ubuntu for WSL**: Download and install Ubuntu from the Microsoft Store to enable Linux-based tools.
- **Install PHP in Ubuntu**: Within the Ubuntu environment, install PHP to work with Laravel Sail if needed.

### 4. Install Composer Dependencies
- Run the following command to install all project dependencies:
  ```bash
  composer install

### 5. Start Docker and Launch Sail
- Make sure Docker Desktop is running, then start your project with Sail by running:
  ```bash
  ./vendor/bin/sail up -d

### 6. (Optional) Create a Sail Alias
- To simplify using Sail commands, consider creating an alias. Instructions can be found in the [Laravel Sail documentation](https://laravel.com/docs/10.x/sail#configuring-a-shell-alias).

### 7. Run Migrations
- Run database migrations by using sail before each Artisan command, like so:
  ```bash
  sail artisan migrate
