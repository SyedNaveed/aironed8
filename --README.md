# Air Choice One

* https://dev.airchoiceone.com
* https://stg.airchoiceone.com
* https://www.airchoiceone.com

## Links

* [InteliSys Customer Portal Support](https://support.intelisysaviation.com/)
* [Amelia Documentation](https://confluence.intelisysaviation.com/display/AD/)
* [Amelia API Documentation](https://airchoiceone-api.intelisystraining.ca/RESTv1/Help)
* [Air Choice One Master V2](https://xd.adobe.com/view/765087b2-0350-4d61-4d06-378a73616ba3-0061/)

## API Example Pages

* [Book Flight](https://airchoiceoneweb.intelisystraining.ca/)
* [Manage Flight](https://airchoiceoneweb.intelisystraining.ca/searchrespax.aspx)

## API Permissions

* Flight Operations
  * Full Schedule - Access (Group)
* Reservations
  * Operations
    * Departure City - Modify (Group)
      * Booking
        * 3rd Party - Access (User)
        * Advanced Reservation Search (Group)
        * Agencies Bookings - Access (Group)
        * AUDIT - Access (Group)
        * Booking - Access (Group)
        * Booking - Modify (Group)
        * Name Change - Modify (User)
        * Reservation Notes - Append (User)
        * Reservation Notes - Modify (User)
        * Reservation Notes - View (User)
          * Shop
            * Ancillary Items - Remove (Group)
          * Vouchers
            * Vouchers - Access (User)
            * Vouchers - Modify (User)
            * Vouchers - Purchase (User)
            * Vouchers - Redeem (User)
      * Passengers
        * Passengers - Access (Group)
        * Passengers - Get List (Group)
        * Passengers - Modify (Group)
  * Administration
    * Agencies
      * Agency - Pseudo City Modify (Group)
    * Vouchers
      * Vouchers - Access (User)
      * Vouchers - Email (User)
      * Vouchers - Modify (User)
    * User Profiles
      * User Profiles - Access (User)
      * User Profiles - Loyalty Access (User)
      * User Profiles - Loyalty Modify (User)
      * User Profiles - Loyalty Points Transfer (User)
      * User Profiles - Modify (User)
  * Finance/Accounting
    * Payment Methods
      * Payment Methods - Access (Group)
  * Reports
    * EMAIL FROM - Modify (Group)
  * Web
    * Passenger Search (Group)
    * View Availability (Group)
      * Edit Site
        * Charges - Add Payment (Group)
        * Charges - Display Charges (Group)
        * Leg - Add (Group)
        * Leg - Cancel (Group)
        * Leg - Edit (Group)
        * Passenger - Add (Group)
        * Passenger - Remove (Group)
        * Passenger - Split Reservation (Group)
        * Reservation Access (Group)
        * Reservation Audit - Access (Group)
        * Reservation Cancel (Group)
        * Reservation Search (Group)
      * Reports
        * Agency Passenger Segments - Access (Group)
        * Agency Payments - Access (Group)
* Utilities
  * Countries
    * Countries - Access (Group)
    * Countries - Get List (Group)
  * Security Administration
    * Group Administration
      * Group - Get List (Group)
    * User Administration
      * User - Get List (Group)
      * User - Modify (Group)
      * User - Own Password Modify (Group)
  * Aircraft Models
    * Aircraft Models - Access (Group)
    * Aircraft Models - Get List (Group)
  * Aircraft Fleet
    * Aircraft Fleet - Access (Group)
    * Aircraft Fleet - Get List (Group)
  * Airports
    * Airport - Access (Group)
    * Airport - Get List (Group)
  * Currencies
    * Currency - Access (Group)
    * Currency - Get List (Group)
  * GL Accounts
    * GL Accounts - Get List (Group)
  * Carriers
    * Carriers - Access (Group)
    * Carriers - Get List (Group)
  * Tax Setup
    * Tax Setup - Access (Group)
    * Tax Setup - Get List (Group)

## Development

### First Time Setup

```sh
bash scripts/misc/first-time-setup.sh
```

### Update Drupal Core and its dependencies

```sh
lando composer update drupal/core webflo/drupal-core-require-dev "symfony/*" --with-dependencies
lando composer update drupal/*
```

### Testing

```sh
lando php bin/behat
```

### Deployments

Deployments happen via BitBucket Pipelines and Git hooks. The server is restricted to the [allowed BitBucket Pipelines IP addresses](https://confluence.atlassian.com/bitbucket/what-are-the-bitbucket-cloud-ip-addresses-i-should-use-to-configure-my-corporate-firewall-343343385.html).

## Changelog

* _2021.02.12 - v1.1.5_
  * Add Advance Passenger Information fields (Redress Number and Known Traveler Number)
* _2021.01.14 - v1.1.4_
  * Add script tag to specific pages and make blue popup boxes on flight selection page editable
* _2021.01.08 - v1.1.3_
  * Fix 'Go Your Way' identifier
* _2020.12.23 - v1.1.2_
  * Update flight times fare text
* _2020.10.30 - v1.1.1_
  * Update Drupal to 8.9.7, update modules, add notification preferences, and allow changing home page background
* _2020.10.05 - v1.1.0_
  * Update Drupal to 8.9.6, update modules, and add flashing to alerts icon
* _2020.08.18 - v1.0.22_
  * Fix multi-passenger ticket prices and additional services calculations
* _2020.07.31 - v1.0.21_
  * Make home page notice links content-managed
* _2020.06.04 - v1.0.20_
 * Add 'ATTN: Ironwood Travel Information' link to home page
* _2020.04.24 - v1.0.19_
 * Add new COVID-19 alerts
* _2020.04.08 - v1.0.18_
  * Open airport information links on itinerary page in a new window
* _2020.04.08 - v1.0.17_
  * Add airport information links to itinerary page
* _2020.03.24 - v1.0.16_
  * Added Coronavirus alert to homepage
* _2020.03.17 - v1.0.15_
  * Fix cancel phone number
* _2020.02.27 - v1.0.14_
  * Fix HTML in Book Flight confirm form, exit after redirect response, and use fare types instead of booking codes
* _2020.02.07 - v1.0.13_
  * Change all 'col-sm-12' form actions to 'col-md-12 col-xs-12'
* _2020.01.30 - v1.0.12_
  * Update Frequent Flyers form fields, change flight selection date switcher to tabs, etc.
* _2020.01.20 - v1.0.11_
  * Replace Honeypot module with the Antibot module, prevent caching custom forms, and update contributed modules
* _2020.01.15 - v1.0.10_
  * Fix Flight Status page flight times
* _2020.01.14 - v1.0.9_
  * Fix times to support local times
* _2020.01.06 - v1.0.8_
  * Don't cache the flight status page
* _2019.12.23 - v1.0.7_
  * Don't cache Flight Status form
* _2019.12.20 - v1.0.6_
  * Adjust Flight Selection Detail Charge Summary to include FET Tax
* _2019.12.20 - v1.0.5_
  * Take care of the fact that they have two booking codes for Go Your Way
* _2019.12.19 - v1.0.4_
  * Replace CSS variables
* _2019.12.18 - v1.0.3_
  * Update Drupal to 8.8.1, update modules, and add Google tracking from old site
* _2019.12.13 - v1.0.2_
  * Fix fares, add Detail link, add date switcher, and content changes
* _2019.12.02 - v1.0.1_
  * Text changes and other launch tweaks
* _2019.11.20 - v1.0.0_
  * Site launched
* _2019.08.19 - v0.0.0_
  * Site development initiated

## Author

DELT  
St. Louis, MO  

[deltstl.com](https://www.deltstl.com)  
