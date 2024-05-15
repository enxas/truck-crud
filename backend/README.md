## Truck CRUD backend

### Installation
Install dependencies with `composer install`  
Rename `.env.example` file to `.env`  
Create migrations with `php artisan migrate`

Start backend with `php artisan serve`

### API endpoints
#### Create new truck
- **Route**: `POST` /trucks

#### Get all trucks
- **Route**: `GET` /trucks

#### Update truck
- **Route**: `PUT` /trucks/:id

#### Get truck
- **Route**: `GET` /trucks/:id

#### Delete truck
- **Route**: `DELETE` /trucks/:id

#### Create subunit
- **Route**: `POST` /subunits

#### Get subunits
- **Route**: `GET` /subunits/:id

#### Delete subunit
- **Route**: `DELETE` /subunits/:id

