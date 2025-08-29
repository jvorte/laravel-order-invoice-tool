# laravel-order-invoice-tool

**Laravel Order & Invoice Automation Tool**

---

## **2. Core Features**

1. **Order Tracking**

* Order tracking (status: pending, paid, shipped, delivered)
* Store customer info (name, email, phone, address)

2. **Notifications**

* Email (Laravel Mail / SMTP)
* WhatsApp (Twilio API or other provider)
* SMS (Twilio / Nexmo)
* Configurable templates for each status

3. **Invoice Generator**

* Create PDF invoices (dompdf)
* Save to /storage/invoices
* Download / Email to customer

4. **Admin Panel**

* Manage orders, customers, templates
* View invoices, export CSV/PDF
* Basic authentication (Laravel Breeze / Jetstream)

## **3. Tech Stack**

* **Backend:** Laravel 10+
* **Frontend:** Blade + Tailwind CSS (small, clean)
* **Database:** MySQL / SQLite
* **PDF:** dompdf
* **Notifications:** Laravel Mail + Twilio API (SMS / WhatsApp)
* **Authentication:** Laravel Breeze / Jetstream

---
