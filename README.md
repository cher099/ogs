# Online Grading System (OGS)

A legacy PHP and MySQL web application for managing academic grading workflows in a senior high school environment.

The project was originally developed for **Gabriel Taborin College of Davao Foundation, Inc. (GTCD)** and contains separate interfaces for students, teachers, and school administrators. Its historical implementation includes student and teacher records, class sections, subjects, school years, grade encoding, grade viewing, and printable grade reports.

> [!WARNING]
> **Legacy software — not suitable for production use in its current state.** This repository was last actively updated in March 2020. A source review identified serious security and data-handling concerns, including hard-coded database connection credentials, plaintext password handling, SQL queries built with interpolated input, and populated sample records in the SQL dump. Do not deploy this application to a public server or use it with real student information without a thorough security remediation and data review.

## Project background

OGS was built as a school grading system prototype for a K–12 senior high school workflow. The repository preserves the historical source code and database structure as they existed during development in 2020.

This repository is maintained as a historical software project and code reference. It is not represented as a currently supported, maintained, or production-ready school information system.

## Functional areas

The current source contains the following areas:

| Area | Observed functionality |
|---|---|
| Student access | Login, view assigned subjects, change password |
| Teacher access | View assigned subjects, manage student grade entries, change password |
| Principal / administrator access | Manage student, teacher, and administrator accounts; sections; subjects; school years; and grade-related records |
| Grade management | Add, update, and remove student-grade associations; encode quarterly and semestral grades |
| Grade reports | Generate printable grade sheets/PDF output using FPDF |
| Data tables | Display and manage tabular records in the browser |

Feature availability and correctness have not been comprehensively retested against a current PHP/MySQL environment.

## Technology stack

The repository contains or references the following technologies:

| Technology | Role |
|---|---|
| PHP | Server-side application logic and page rendering |
| MySQL / MySQLi | Relational database access |
| HTML and CSS | Page structure and presentation |
| JavaScript | Browser-side interaction |
| jQuery 3.4.1 | DOM utilities and AJAX |
| Bootstrap | Responsive layout and UI components |
| SB Admin 2 | Dashboard/admin interface theme |
| DataTables | Tabular data presentation |
| Select2 | Enhanced select controls |
| Vue.js | JavaScript library included in the application assets |
| Font Awesome | Icons |
| FPDF 1.8.2 | PDF generation |

The project does not currently include a Composer manifest, Node package manifest, or automated dependency installation workflow. Front-end libraries are stored directly in the repository.

## Application structure

The application uses a PHP front controller and a simple include-based routing approach.

```text
ogs/
├── index.php              # Main entry point
├── printgrade.php         # Printable grade report generation
├── database/
│   └── ogs.sql            # MySQL schema and historical sample data
├── sys/
│   ├── actions.php        # Form submissions and data mutations
│   ├── api.php            # AJAX/API-style actions
│   ├── helpers.php        # Shared helpers, session setup, DB wrapper
│   └── routes.php         # Page routing and role-specific views
├── views/
│   ├── admin/             # Administrative screens
│   ├── inc/               # Shared layout and messages
│   ├── student.php        # Student interface
│   ├── teacher.php        # Teacher interface
│   ├── principal.php      # Principal/admin interface
│   └── login.php          # Login screen
├── assets/
│   ├── css/               # Stylesheets and UI libraries
│   ├── js/                # JavaScript libraries
│   ├── imgs/              # Application images
│   └── images/            # Library assets
└── fpdf182/               # FPDF library and bundled documentation
```

The directory listing above is representative of the tracked source tree; consult the repository for the complete asset inventory.

## Historical setup reference

The original code targets a local PHP/MySQL environment and contains a database export at `database/ogs.sql`. The application is not currently configurable through environment variables or a dedicated configuration file.

Because the checked-in source includes unsafe credentials and other security issues, **do not follow the historical configuration as-is and do not import the SQL dump into a database containing real data.** The steps below are intended only as a controlled, isolated review setup after the security concerns have been addressed.

### Requirements

The source was developed around the following historical environment, recorded in the SQL dump:

- PHP 7.3-era runtime
- MySQL 8.0-era database
- Web server capable of executing PHP
- PHP MySQLi and PDO extensions

These are historical references, not a recommendation to deploy obsolete runtime versions. A current compatible runtime must be selected and tested before any maintenance work.

### Database

The SQL export is located at:

```text
database/ogs.sql
```

It creates a database named `ogs` and includes both schema definitions and populated example rows. Treat those rows as potentially sensitive: inspect and sanitise the dump before sharing, importing, or using it outside an isolated test environment.

### Configuration

Database connection details and the base URL are currently embedded in `sys/helpers.php`; another database connection is embedded in `printgrade.php`. These values must be moved to secure configuration outside the public document root and secrets must not be committed to source control before the application can be safely configured.

No ready-to-use installation procedure is provided because the existing configuration is not safe for direct deployment.

## Security status and known risks

A limited static review of the checked-in source identified the following issues. This is not a full security audit, and additional vulnerabilities may exist.

| Finding | Evidence in the current source | Required remediation |
|---|---|---|
| Hard-coded database credentials | Database connection values are embedded in `sys/helpers.php` | Rotate any exposed credentials; use environment-based or protected configuration outside the web root |
| Plaintext password handling | Login compares submitted passwords directly with stored values; SQL dump contains plaintext-looking account values | Invalidate exposed sample credentials; implement `password_hash()` and `password_verify()`; reset all real accounts |
| SQL injection exposure | Request values are interpolated into SQL strings in actions and API handlers | Replace dynamic SQL with prepared statements and strict input validation |
| Weak database privilege model | Connection uses a database superuser-style local account in the checked-in helper | Create a least-privilege application database user |
| Public sample personal data | SQL dump contains student names, addresses, dates of birth, identifiers, and account fields | Remove or replace data with synthetic fixtures; review repository history and access exposure |
| Destructive actions via GET | Delete operations are triggered through query parameters | Use authenticated POST actions, CSRF protection, and server-side authorization |
| Session hardening not evident | Session is started, but session ID regeneration and related protections are not evident in the reviewed helper | Implement secure cookie settings, session ID regeneration, timeout, and logout invalidation |
| Role/authorization checks need review | Route and action logic has role checks in some places but not consistently across all operations | Centralize authorization checks and test each role/action combination |
| Output encoding needs review | Dynamic database values are rendered in views | Contextually escape output to prevent cross-site scripting |

### Important repository hygiene

Before making this repository available as a reusable public example:

1. Remove real or realistic personal information from tracked SQL dumps and other fixtures.
2. Rotate any database passwords or account credentials that may have been used outside a local disposable environment.
3. Review the full Git history for exposed credentials and sensitive records; deleting them from the latest commit alone does not remove historical copies.
4. Avoid publishing screenshots or sample exports containing student data.
5. Review the licenses and notices for bundled third-party libraries before redistributing the repository under a project-level license.

Do not use this application to process real student records until these issues have been remediated and the system has undergone appropriate security and privacy review.

## Development and maintenance status

- **Original development period:** February–March 2020
- **Default branch:** `master`
- **Current status:** Legacy / archived in practice; no recent application development is visible in the commit history reviewed for this documentation.
- **Automated tests:** No test suite was identified in the inspected repository tree.
- **Modern deployment guide:** Not yet available.
- **Production readiness:** Not established.

## License

No project-level open-source license is currently included.

This repository contains bundled third-party components (including FPDF and front-end libraries) and has commit history involving more than one contributor. A project-wide license should not be added until the ownership and redistribution rights for the application code, bundled dependencies, and included assets have been confirmed.

See the notices and license terms distributed with each third-party component before reuse.

## Disclaimer

This project is provided as a historical code reference. It is supplied without warranties or guarantees of fitness, security, accuracy, or continued operation. Use, modification, deployment, and handling of any data are the responsibility of the person or organisation undertaking those activities.

---

**Project:** Online Grading System (OGS)  
**Original context:** Gabriel Taborin College of Davao Foundation, Inc.  
**Repository:** [github.com/cher099/ogs](https://github.com/cher099/ogs)  
**Original development period:** 2020  
**Status:** Legacy project
