# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project context

This is the website for **KASAROSE LOGISTICS**, a holding company operating across import & export
shipping, real estate and property management (kasarose.com). It was originally a purchased "TransHub" HTML
template (Bootstrap 5) that has since been rebuilt as a PHP site with shared includes and real group content.

**Renamed August 2026.** The group was called *KasaBazaar Group of Companies* and lived at kasabazaar.com until
August 2026. The only places the old name still legitimately appears are historical: the `alternateName` in the
`schema.org` block in [partials/head.php](partials/head.php), the "known as KasaBazaar until 2026" clauses in
[includes/config.php](includes/config.php) and [faq.php](faq.php), the "formerly KasaBazaar Group of Companies"
definitions in [privacy-policy.php](privacy-policy.php) and [terms.php](terms.php), and the still-live
`support@kasabazaar.com` SMTP account (see **Form submission & mail** below). Anywhere else, it is stale copy.

**RDD Shipping absorbed August 2026.** RDD Shipping (Rose Door-to-Door Shipping & Delivery Service) — the group's
former freight logistics subsidiary — was folded into KASAROSE LOGISTICS itself; it is no longer a separate
company. Its freight services (air/sea freight, ecommerce package forwarding, shipment tracking) are now offered
directly by this company, and its public marketing content (About, Services, gallery, news, feedback) was merged
into this site. Its Laravel application (`Projects/kasabazaar`) was **not** decommissioned — it continues to run
as this site's **back-office**: Filament admin, client/investor portals, mobile API, and — most importantly for
this repo — the shipment database that [tracking.php](tracking.php) reads live. See **Back office & shipment
data** below. rddshipping.com should eventually redirect to this site's equivalent pages, but that migration is
**not yet done** — see the note at the end of that section.

The group's remaining sister companies — referenced throughout the site (home page,
[our-companies.php](our-companies.php), footer, legal pages) but **not part of this repo** — are:
- **Neoride Africa** (neorideafrica.com) — the group's mobility company (tricycle transport in Ghana).
- **KROSEMARKET** (krosemarket.com) — the group's multi-vendor ecommerce marketplace, added to the group in
  August 2026. It has been branded *KasaBazaar Market*, then *KASAROSE*, then *KASAROSE Marketplace*, before
  settling on **KROSEMARKET**; all of those are stale copy now. Because the marketplace's name no longer starts
  with "KASAROSE", bare "KASAROSE" unambiguously means the parent group everywhere on this site — the earlier
  "always write KASAROSE Marketplace, never bare KASAROSE" disambiguation rule no longer applies and should not
  be reintroduced.

## Group of Companies — cross-site sync (IMPORTANT)

This site is **one of three sibling websites**, each in its own repository, that reference each other in
navigation, footers and legal pages — plus one back-office application that is not a public sibling site:

| Company | What it is | Repo | Stack |
|---|---|---|---|
| **KASAROSE LOGISTICS** | This site — group site, freight, real estate, property management | this repo | Plain PHP + Bootstrap, Gulp/SCSS |
| Neoride Africa | Tricycle mobility, last-mile transport | `Projects/neoride` | Plain PHP template |
| KROSEMARKET | Ecommerce marketplace | `Projects/website/kmarket` | Laravel 12 + Livewire + Filament 4 |
| *(back-office, not a sibling site)* `Projects/kasabazaar` | Filament admin, portals, mobile API, shipment DB | Laravel 11 + Filament 3 |

(All four live under `C:/xampp/htdocs/`.)

**Every company roster lives in exactly one file per repo. Never hardcode a sister company's name or URL in a
template — read it from the roster.**

| Repo | Roster file |
|---|---|
| this repo (here) | [includes/config.php](includes/config.php) — `$group_companies`, `SITE_URL_KROSEMARKET`, `SITE_URL_NEORIDE` |
| kmarket (KROSEMARKET) | `config/group.php` |
| neoride | `parts/group_companies.php` |
| kasabazaar (back-office) | `config/group.php` — still describes the pre-absorption four-company group as of this writing; **not yet updated**, see the sweep note below |

### The rule

**Before you finish any change that touches company identity, cross-links or legal/policy copy, check whether the
same change is needed in the other repositories — and make it there too, in the same session.**

Changes that always require the cross-repo sweep:

- Adding, renaming or removing a group company, or changing its tagline, role or one-line description. Note the
  copy that counts companies: `our-companies.php` says "One Group, Three Companies" and `about.php` says "grew
  from one idea into three companies" — both need updating if the count changes again.
- Changing any company's production domain (edit the `SITE_URL_*` constants, never a template).
- Any edit to [privacy-policy.php](privacy-policy.php), [terms.php](terms.php) or
  [delivery-policy.php](delivery-policy.php) — each names the other companies and describes what data or work
  passes between them. If this site's privacy policy says a marketplace order question goes to KROSEMARKET,
  KROSEMARKET's own privacy policy must describe the same flow from its side.
- Changing the operational relationship between companies (who carries what, who is the point of contact).
- Changing shared contact details (the `CONTACT_*` constants here are the group's published numbers and are
  mirrored in the other repos' contact blocks).

Changes that do **not** need the sweep: page layout, SCSS, imagery, service-page copy that names no other company.

**Known outstanding sweep (from the August 2026 RDD absorption + rename):** `Projects/kasabazaar`'s
`config/group.php` and `Projects/neoride`'s `parts/group_companies.php` were **not** updated as part of that work
in this repo — they may still describe a four-company group with RDD as a peer and/or the marketplace under an
old name or domain. Treat this as known-stale, not as a green light to assume those repos already agree with this
one; reconcile them before relying on their content.

### Where the cross-links surface here

- [includes/config.php](includes/config.php) — the roster plus the `SITE_URL_*` constants every outbound link uses.
- [our-companies.php](our-companies.php) — one full section per company; KROSEMARKET's section is last.
- [index.php](index.php) — the teaser grid loops `$group_companies` (three-up: `col-lg-4 col-md-6`).
- [partials/footer.php](partials/footer.php) — the "Our Companies" link column and the about blurb.
- [partials/head.php](partials/head.php) — the `schema.org` `Organization` JSON-LD carries `subOrganization` and
  `sameAs` entries for the two sister companies (Neoride Africa, KROSEMARKET). Adding or removing a company means
  editing this too.
- [faq.php](faq.php), [about.php](about.php) — prose that enumerates the companies.

### Note on delivery policy scope

[delivery-policy.php](delivery-policy.php) covers **freight arranged through KASAROSE LOGISTICS only** (which now
includes the door-to-door freight formerly run as RDD Shipping). Orders bought on KROSEMARKET are governed by
KROSEMARKET's own delivery and returns policies, and that carve-out is stated explicitly on the page. Do not fold
marketplace timeframes into `$delivery_timeframes` here — KROSEMARKET keeps its own set in `config/group.php`.

Real contact info, service descriptions and group structure live in [includes/config.php](includes/config.php) —
check there before inventing or changing any phone number, email, or company description. Avoid adding fabricated
statistics, staff bios, or client testimonials; this template originally shipped with plenty of them (fake team
photos, invented "years of experience" counters, a fake client-logo carousel) and they were deliberately removed.
The one deliberate exception is the **Team** section on [about.php](about.php): those five photos and names
(J.W. Adel, Rose N. Adel, Tina Arhin, Esther Gyebour Fosu, Osei Kwaku) are real staff carried over from the RDD
Shipping site, not stock — don't treat them as the same category of filler as the removed fake content, and don't
add fabricated names alongside them.

## Back office & shipment data

`Projects/kasabazaar` is a Laravel 11 + Filament 3 application. It is **not a sibling public website** — it is
the back office this site depends on:

- **Filament admin** — where staff manage shipments, branches, blog posts, and everything else. The "Staff"
  nav dropdown in [partials/header.php](partials/header.php) links here via `ADMIN_URL` (= `BACKOFFICE_URL` +
  `/admin`, defined in `includes/config.php`).
- **The shipment database** — this site reads it directly, read-only, to power live tracking and the news/blog
  pages. See below.
- Client/investor portals, the mobile app's API, and the Paystack payment flow all still live there and are
  unaffected by anything in this repo.

**`CONFIRM BEFORE LAUNCH`**: `BACKOFFICE_URL` in `includes/config.php` still points at `rddshipping.com` — that
domain has not been repointed to a `kasarose.com` subdomain, and rddshipping.com's own marketing pages have not
been redirected to their equivalents here. Both are open decisions, not oversights; don't "fix" one without the
other, and don't assume either has happened.

### Reading the shipment database

[includes/db.php](includes/db.php) is a **read-only** PDO layer, deliberately narrow in what it exposes:

- `kr_db()` — lazily opens a PDO connection using `includes/db-config.php` (gitignored — see
  [includes/db-config.example.php](includes/db-config.example.php) for the template and the `GRANT SELECT`
  statements a production account should have). Returns `null` if that file is missing or the connection fails —
  **callers must treat `null`/`false` as "can't look this up right now," never let it fatal a public page.**
- `kr_find_shipment($query)` — looks up one shipment by `tracking_number` or `shipping_reference` against
  `shipments` joined to `branches` (origin/destination). Returns the shipment array, `null` for "not found," or
  `false` for "the lookup itself failed" — [tracking.php](tracking.php) shows a different message for each.
- `kr_shipment_timeline($reference)` — a status history built by unioning `trackings` (branch-scoped status
  changes) and `shipment_updates` (free-text location notes), since the Laravel app writes to both and neither
  alone is authoritative.
- `kr_status_meta($status)` — maps the `shipments.status` enum (`pending` / `in transit` / `delivered` /
  `cancelled`) to the label/step/badge-class the tracking page's three-stage progress bar uses.
- `kr_blog_posts()` / `kr_blog_post($slug)` — published (`status = 1`) rows from `blogs`/`blog_categories`, used
  by [news.php](news.php) / [news-detail.php](news-detail.php). Posts are authored in the Filament admin; this
  site only ever reads them.
- `kr_blog_image($path)` — resolves an uploaded blog image to `BACKOFFICE_URL/storage/<path>`, since Filament's
  `FileUpload` stores images on the back-office host, not this one.
- `kr_rich_text($html)` — the blog `content` field is rendered as real HTML (it comes from a Filament rich-text
  editor, not user input), but is passed through a tag whitelist and has `on*` handlers and `javascript:` URLs
  stripped first. **Never** `echo` `$post['content']` directly — always through this function. A compromised or
  careless admin account should not be able to turn a published post into stored XSS on this domain.

**Rules for anything added to `includes/db.php`:** SELECT only, never write. Expose only what a person holding a
tracking number is entitled to see — reference, status, branch names, dates. No client names, addresses, costs,
or payment state. Fail soft, always.

**Why the feedback form doesn't write to the database:** `customer_feedback` has a UUID primary key, a checked
`rating` column, and belongs to a model with Eloquent-side validation and events. [feedback.php](feedback.php)
deliberately does **not** attempt a direct INSERT — it emails the submission through `mailer.php` like every
other form on this site (see below), same as contact and quote requests. If a future feature genuinely needs
this site to write to that database, treat it as a bigger decision than adding a new PDO query: it means
bypassing Laravel model logic from PHP that doesn't share its validation rules.

## Build commands

Frontend build tooling is Gulp-based (see [gulpfile.js](gulpfile.js)):

- `npm install` — install devDependencies (gulp, sass, postcss/cssnano, terser, browser-sync, gulp-tinypng)
- `npx gulp scssTask` (or `npm run build-scss`) — compile SCSS once: [app/scss/style.scss](app/scss/style.scss) →
  minified `css/style.css` (+ sourcemap) via `gulp-sass` and `cssnano`. `scssTask`/`jsTask` are exported as
  standalone tasks specifically so they can be run this way without booting BrowserSync.
- `gulp` (default task) — runs `scssTask`, then `jsTask` (minifies `app/js/custom.js` → `js/custom.js` via terser),
  then starts BrowserSync serving the repo root and a `watchTask` that live-reloads on `*.html`/`*.php` changes and
  rebuilds SCSS/JS on changes under `app/scss/**` or `app/js/**`.
- There is no lint or test command; `npm test` is an unconfigured placeholder.
- No PHP build step is needed — pages are plain `.php` files served directly by a PHP-capable server (e.g. XAMPP
  at `http://localhost/.../KasaRose%20Website/index.php`, or `php -S 127.0.0.1:8990` for a quick local smoke test).
  Opening the files directly (`file://`) will not execute the PHP.

**Important**: never hand-edit the compiled files [css/style.css](css/style.css) or [js/custom.js](js/custom.js)
directly — they are generated. Edit the sources in `app/scss/` or `app/js/custom.js` and rebuild.

## Architecture

**Pages are PHP with shared includes** — there is no duplicated header/nav/footer markup per page. Every top-level
`*.php` page follows the same skeleton:
```php
<?php
$page_title = '...';
$meta_description = '...';
require 'partials/head.php';   // <head>, opens <body>, preloader
require 'partials/header.php'; // offcanvas menu, topbar-less nav (see below)
?>
   ... page body ...
<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
```
- [partials/head.php](partials/head.php) pulls in [includes/config.php](includes/config.php) (constants +
  `$group_companies` array) and renders the `<title>`/meta description from the page's `$page_title`/
  `$meta_description` variables.
- [partials/header.php](partials/header.php) uses the **dark `header-2`** nav style (template's original demo
  variant — a translucent dark pill nav floating over the hero/promo image, with a `header-top` info bar above
  it), not the light `header-default` used earlier. It carries `images/kasarose-logistics-logo-h-white.png` (the
  white knockout horizontal lockup) in both the navbar-brand and the offcanvas-nav header, since both sit on dark
  backgrounds now — never swap those back to the non-white lockup, it'll be unreadable. The `header-top` bar shows
  real contact info only (US phone, Ghana phone, support email, collapsing to a "Contact Info" dropdown below
  `xl`) — no language selector or social-share icons, because neither is real for this site (no i18n, no social
  profiles exist anywhere else in the codebase); don't add them back without an actual account/service behind
  them. The circular **search** icon that sat next to the burger was removed for the same reason: its input had no
  `name`, its form no `action` and there is no handler for it anywhere in `custom.js`, so submitting it only ever
  reloaded the page — don't re-add a search affordance without a search implementation behind it. The current page
  is marked in the nav via `kr_active()` (see `includes/config.php`). **The main nav itself is kept deliberately short** — Home, About Us, Our Companies, Services (dropdown),
  Request Quote, Tracking, Contact Us — every item a prospective customer would look for. Secondary/internal links
  live in [partials/footer.php](partials/footer.php) instead: the "Quick Links" widget carries Our Work, News,
  FAQ's and Feedback, and the footer-bottom bar (next to the legal links) carries **Staff Login**/**Staff Mail**
  (`ADMIN_URL` / `STAFF_MAIL_URL`, defined in `includes/config.php`). There used to be a "More" dropdown and a
  "Staff" dropdown in the main nav duplicating both of those — they were removed from the header in favor of the
  footer versions that already existed, so don't re-add them there. The separate `canvas-menu` offcanvas panel
  (opened via the circular burger icon, not the "Menu" hamburger) sits on a white background regardless of header
  variant, so it keeps the non-white (colored) logo and its own condensed "Our Services" + "Quick Links" block,
  independent of everything above.

**Logo assets** — all derived from `logo-to-use.jpeg` (the rebrand announcement graphic) by a one-off Pillow script
  that classifies each pixel against the flat brand palette per region and rebuilds it with a real alpha channel.
  Regenerate the whole set together, never one file alone:

  | File | What it is |
  |---|---|
  | `images/kasarose-icon.png` | the K mark alone |
  | `images/kasarose-logistics-wordmark.png` | KASAROSE over LOGISTICS, no mark |
  | `images/kasarose-logistics-logo.png` | stacked lockup — used as the Open Graph image and the roster logo |
  | `images/kasarose-logistics-logo-h.png` | horizontal lockup — used in the nav and on the letterheads |
  | `*-white.png` | white knockout of each of the above, red wedge preserved, for dark backgrounds |

  The nav caps the lockup at `max-height: 42px; max-width: 178px` with a `26px` right gutter **on the img, not the
  link** — a later rule in `_header.scss` resets `.navbar-brand`'s own margin to 0. The footer uses the white
  horizontal lockup directly on the dark parallax (the old white rounded box behind it is gone).

  **KROSEMARKET's logo** (`images/krosemarket-*.png`) is generated separately by
  [tools/make-krosemarket-logo.py](tools/make-krosemarket-logo.py), *not* the Pillow pipeline above. It reuses the
  actual K/R/O/S/E/A letterforms cut out of `images/kasarose-logo.png`'s wordmark (same face, exact match) and
  draws the missing M/T glyphs to that face's measured metrics, so the two brands read as one family without
  KROSEMARKET being mistakable for the parent. Re-run that script, don't hand-edit the outputs, if the source
  KASAROSE wordmark ever changes.
- [partials/footer.php](partials/footer.php) and [partials/scripts.php](partials/scripts.php) are the shared footer
  and the common `<script>` tag list respectively.
- [partials/cta.php](partials/cta.php) is the closing call-to-action band (dark parallax, eyebrow + heading +
  buttons). It used to be copy-pasted into five pages and missing from the other sixteen, so most of the site ran
  out of content straight into the footer. Set `$cta_eyebrow` / `$cta_heading` (and optionally `$cta_buttons`, a
  list of `['label','href','style' => 'primary'|'outline']`) and `require 'partials/cta.php';` immediately before
  the footer. It is on every page except `contact`, `quote` and `404` — which already *are* the destination it
  points at — and the three legal pages, where a marketing band under a policy document reads as an upsell.
  Don't reintroduce an inline copy of this markup on a new page.
- [partials/service-sidebar.php](partials/service-sidebar.php) is the sidebar shared by all seven service detail
  pages: the full service list from `$site_services` with the current page marked, plus a contact block. Override
  the button with `$sidebar_cta = ['label' => ..., 'href' => ...]` before requiring it (real-estate and
  property-management point at `contact.php` rather than the freight quote form). The freight pages each used to
  carry their own copy of the list under a different heading — don't hand-list services in a page again.
- [includes/config.php](includes/config.php) is the single source of truth for contact info (US/Ghana phone
  numbers, support email, the Ghana office address and its Maps embed), the back-office URLs (`BACKOFFICE_URL`,
  `ADMIN_URL`, `STAFF_MAIL_URL`), and the `$group_companies` array (KASAROSE LOGISTICS, Neoride Africa,
  KROSEMARKET) plus the `SITE_URL_*` outbound-link constants, which both `index.php` and `our-companies.php` loop
  over — update data there, not in individual pages. It also holds:
  - `$site_services` — the seven service pages, `filename => label`, in nav order. The nav dropdown, the footer's
    "Our Services" column, the offcanvas canvas-menu and `partials/service-sidebar.php` all loop over it. Every
    one of those lists was hand-maintained and had drifted (warehousing.php was in the nav but in neither the
    footer nor the canvas menu). **Add a service here, not in a template.**
  - `kr_current_page()` / `kr_active(...$pages)` — `kr_active()` returns `' active'` when the page being rendered
    is one of its arguments, for interpolating straight into a `class` attribute. The main nav uses it to mark the
    current page (the Services parent takes `...array_keys($site_services)` so it lights up on any service page);
    `.nav-link.active` and `.dropdown-item.active` are styled in `_header.scss`.

**SCSS structure**: `app/scss/style.scss` imports base partials in order —
`_variables`, `_mixins`, `_typography`, `_animation`, `_theme`, `_header`, `_footer`, `_widget`, `_swiper` — then one
file per page-section under `app/scss/components/`. The components for the dropped pages (`brands`, `review`,
`pricing`, `shop`, `single-product`, `cart`, `checkout`) are **no longer imported** — none of their classes appear
in any `.php` file, and `pricing.scss` was the only thing referencing `images/icons/cross.png` and `check2.svg`,
neither of which exists, so the compiled CSS was carrying dead background-image requests. The `.scss` files are
still on disk; if a dropped page is ever resurrected, re-add its `@import` rather than rewriting the component. `_variables.scss`'s `--primary`/`$theme-colors` primary was
changed to the red sampled from the KASAROSE LOGISTICS logo (`#E4252C`), and `--dark`/`--headings-color` to the
logo's navy (`#052240`). `$theme-colors`' unused `secondary`/`tertiary` were pulled onto brand too (navy and the
wordmark grey `#727275`). Earlier palettes you may still meet in old markup: the template's stock orange
`#FD5523`, then KasaBazaar's red `#DB171C` and navy `#020E28` — update any of them to `#e4252c` / `#052240`.
**Never hand-edit `css/style.css`** — run `npx gulp scssTask` after touching any `.scss`.

**Page inventory**: `index`, `about`, `our-companies` (showcases the group's 3 companies), `services`
(overview) with sub-pages `air-freight`, `ocean-freight`, `road-freight`, `warehousing`, `ecommerce-logistics`,
`real-estate`, `property-management`, `quote`, `tracking` (live shipment lookup — see **Back office & shipment
data**), `contact`, `faq`, `privacy-policy`, `terms` (Terms & Conditions / Terms of Use — one combined document,
not split further), `delivery-policy`, `404`, plus three pages absorbed from the RDD Shipping site in August
2026: `projects` (a real photo gallery of KASAROSE operations, not stock), `news` / `news-detail` (reads the
back-office `blogs` table), and `feedback` (emails a rating/complaint form — see **Back office & shipment data**
for why it doesn't write to the database). The original template's blog/shop/cart/checkout/login/register/team
/case-studies/pricing/single-post/single-product pages and `rail-freight` (no group company offers rail) were
deliberately dropped as not relevant to this site — don't resurrect them without deliberate discussion, since
removing them was itself a scoped decision. Note `news`/`news-detail` reuse the template's blog/single-post
styling (`blog.scss`, `single-post.scss`) rather than being a resurrection of the dropped generic blog pages —
that's expected. The three legal pages are linked from the footer's bottom bar (`footer.php`) and listed in
`sitemap.xml` — add new pages to both when creating them. `news-detail.php` is intentionally **not** in
`sitemap.xml` (it's a dynamic per-post page, not a static one) — don't add it there; if per-post sitemap entries
are ever wanted, generate them dynamically rather than hand-listing slugs.

**Form submission & mail**: forms (contact, quote request, feedback) post via jQuery AJAX using
[js/form.js](js/form.js), which serializes `#ajax-contact` and POSTs to the form's `action` (`mailer.php`),
writing the response into `#form-messages`, then calls `form[0].reset()` on success — **not** a hardcoded list of
field ids, so a new form or a new field on an existing form is cleared automatically; don't revert to an id list.
[mailer.php](mailer.php) is field-driven: a `$fields` map of every POST key any form may send to the label it
should appear under in the email, plus a `form_type` hidden input (`quote` / `contact` / `feedback`, matched
against a fixed whitelist — **never** echo an arbitrary POST value into the subject line) so the team can triage
by subject. Adding a field to a form means adding it to `$fields`; anything not listed there is silently dropped
rather than forwarded, so don't assume a new `<input name="...">` will show up in the email without that step.
`mailer.php` sends through **PHPMailer** (installed via Composer — see `vendor/`, `composer.json`) over SMTP, not
PHP's native `mail()`. SMTP credentials (Hostinger: `smtp.hostinger.com:465`, account `support@kasabazaar.com` —
still the old domain, and still the account that actually sends; `CONTACT_EMAIL_SUPPORT` is the new
`support@kasarose.com`) live in `includes/mail-config.php`, which is **gitignored and not checked in** — if that
file is missing, `mailer.php` will fatal on `require`; recreate it locally with
`SMTP_HOST`/`SMTP_PORT`/`SMTP_SECURE`/`SMTP_USERNAME`/`SMTP_PASSWORD` constants (see `.gitignore`). All form
submissions are addressed to every inbox in the `$form_recipients` array in `includes/config.php`
(`kasabazaar109@gmail.com`, `support@kasarose.com`, `support@kasabazaar.com` — the list is expected to grow),
regardless of which SMTP account sends them. `mailer.php` drops blank, malformed and duplicate entries before
sending, so one bad address costs that recipient rather than the whole submission. **Add a recipient to that
array, never to `mailer.php`** — the `CONTACT_EMAIL_GENERAL` constant it replaced no longer exists. Any new
form should reuse this same `#ajax-contact` / `#form-messages` / `form.js` pattern, add its
fields to `mailer.php`'s `$fields` map and a `form_type` value, and post to `mailer.php` rather than introducing a
new submission mechanism.

**SEO**: [partials/head.php](partials/head.php) auto-derives canonical URL, Open Graph/Twitter tags, and a
`schema.org` Organization JSON-LD block from `SITE_URL` (in `includes/config.php`, currently the production
domain `https://kasarose.com`) and each page's `$page_title`/`$meta_description` — don't hardcode per-page
`<meta>`/canonical tags, just set those two variables like every other page does. Root-level
[robots.txt](robots.txt) and [sitemap.xml](sitemap.xml) are static files listing the pages above (excluding
`404.php` and `news-detail.php`, see above); add new pages to both when creating them.

**Favicon**: generated from the logo's K icon mark (not the full wordmark, which is unreadable at 16px) via a
one-off Pillow crop — see `images/favicon.ico`, `favicon-16x16.png`, `favicon-32x32.png`, `apple-touch-icon.png`,
`android-chrome-{192,512}x{192,512}.png`, and `site.webmanifest`. Regenerate all of these together from
`images/kasarose-icon.png` if the logo ever changes; don't hand-edit one size independently of the others.

**Assets**: `images/` holds page imagery — mostly still original template stock photos, but as of the August
2026 RDD absorption it also holds two directories of **real** KASAROSE photography carried over from the RDD
Shipping site: `images/gallery/` (24 operational photos — cargo, containers, warehousing — shown on
[projects.php](projects.php)) and `images/team/` (5 real staff photos shown in the Team section of
[about.php](about.php)). Both were re-encoded down from their ~30MB/~1.4MB originals for web delivery — if
replacing or adding to either directory, keep images under roughly 1400px wide and re-compress rather than
committing camera-original files. (`esther-gyebour-fosu.jpg` and `tina-arhin.png` were missed in that first pass
and re-encoded later — a 3507×4384/9.6MB original and a 488KB RGBA PNG in a row of ~30KB JPEGs. The high-res
master of the first is no longer in this repo; ask the team for it if a larger crop is ever needed.)

`images/gallery/` is no longer used only by `projects.php`. The real photographs now also carry the hero image on
`warehousing`, `ecommerce-logistics`, `road-freight`, `real-estate` and `property-management`, the two-up photo
pair on each of the four freight detail pages, and the KASAROSE section of `our-companies.php` — all of which
previously showed template stock whose subject contradicted the page (a container yard under "Real Estate", a
courier van under "Property Management", and the same container-port photo on both `warehousing` and
`ecommerce-logistics`, because `Warehousing.jpg` and `logis.jpg` were byte-identical; `Warehousing.jpg` has been
deleted). **Prefer a real gallery photo over template stock whenever one fits the subject.**

`images/serv-s7.png`, `serv-s8.png` and `serv-s9.png` (the Real Estate, Property Management and Warehousing
service-card tiles) are generated by [tools/make-service-tiles.py](tools/make-service-tiles.py) from gallery
photos, pushed through the alpha mask of `serv-s1.png` so their corner radii match the six the template shipped.
Re-run that script; don't hand-edit the outputs.

**Neoride Africa has no imagery in this repo** — its section on `our-companies.php` falls back to a generic road
photo. If a real Neoride photo or logo becomes available, that is the place to use it. Everything else under `images/` is still template stock — don't conflate the
two; treat non-gallery/non-team imagery as a known placeholder, not a factual claim. The `tinypng` Gulp task
(`images/*` → `dist/`, PNG/JPEG only) is available for compression but isn't wired into the default pipeline and
needs the TinyPNG API key already embedded in [gulpfile.js](gulpfile.js).
