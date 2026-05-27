"# dreamhome" 

DreamHome is a modern, cross-platform rental property management ecosystem designed to bridge the gap between prospective tenants and their next ideal home. It solves the critical challenge of long-distance property hunting by allowing users to explore listings, track details, and coordinate inspections remotely without the need for immediate, costly on-site visits. Built to streamline operations for both clients and real estate teams, the platform transforms a traditionally tedious search into a seamless digital pipeline.

Multi-Role Authentication & Authorization:
Features distinct, secure access portals for prospective renters (to browse and request viewings) and administrative personnel (managers, supervisors, and secretaries) to securely oversee backend operations.

Responsive & Mobile-Friendly:
Designed with a mobile-first approach, ensuring the client-side viewing request portal and administrative tracking tools are completely accessible on mobile interfaces and emulators.

Automated Viewing & Inspection Workflow:
Allows clients to request physical on-site viewings directly through the interface, which staff can review, approve, and instantly assign to available field agents. 

Comprehensive Administrative Dashboard:
Empowers management to handle full-scale business operations, including adding new branches, managing property inventories, tracking active leases, logging property inspections, and onboarding new staff.


TECH STACK USED

### Frontend
   **Framework:** Laravel (Blade Templates)
   **Styling:** Tailwind CSS, HTML5, CSS3
   **Scripting:** JavaScript

### Backend & Database
   **Language/Framework:** PHP / Laravel
   **Database Management System:** PostgreSQL


TO LOG IN AS STAFF:
  EMAIL: 
      jdiaz@email.com,
      addianne.alforque@email.com,
      joshmarc@email.com,

  PASSWORD:
      dreamhome123
        

# Installation Guide

## Clone the Repository

```bash
git clone https://github.com/Adricator/dreamhome
```

## Go to Project Folder

```bash
cd dreamhome
```

## Install Dependencies

```bash
composer install
npm install
```

## Configure Environment

Copy `.env.example` into `.env`

```bash
cp .env.example .env
```

## Generate Application Key

```bash
php artisan key:generate
```

## Configure PostgreSQL Database

Update your `.env` database credentials.

## Run Migrations

```bash
php artisan migrate --seed
```

## Start the Server

```bash
php artisan serve
```

## Database Design

The system uses PostgreSQL with normalized relational tables
for managing:

- Properties
- Branches
- Staff
- Owners
- Clients
- Viewings
- Leases
- Inspections


# Core Modules
- Client Module
- Staff Module
- Property Module
- Branch Module
- Owner Module

# User Roles

## Prospective Renters
- Browse properties
- Request viewings
- Track requests

##STAFF
 **Managers
- Manage branches
- Approve requests
- Monitor operations

 **Supervisors
- Assign field agents
- Manage inspections

 **Secretaries
- Manage records
- Update listings


# Sample Routes

| Route | Description |
|------|------|
| /login | User Login |
| /properties | Property Listings |
| /dashboard | Admin Dashboard |


# Contributors

- Adrianne Alforque
- Joshua Marc Layong
- Joshua Diaz
- Kyle Ayatal
