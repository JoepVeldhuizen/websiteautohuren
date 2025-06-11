<?php
require_once '../includes/header.php';
?>

<style>
.help-section {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.help-title {
    color: #1a73e8;
    font-weight: 600;
    margin-bottom: 2rem;
}

.contact-form .form-control {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px;
    transition: all 0.3s ease;
    font-size: 15px;
}

.contact-form .form-control:focus {
    border-color: #1a73e8;
    box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.2);
}

.contact-form .form-select {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px;
    transition: all 0.3s ease;
}

.contact-form .form-select:focus {
    border-color: #1a73e8;
    box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.2);
}

/* Improved textarea styling */
.contact-form textarea.form-control {
    min-height: 150px;
    height: 150px;
    resize: none;
    line-height: 1.6;
    font-family: inherit;
    background-color: #f8f9fa;
    border: 2px solid #e0e0e0;
    padding: 15px;
    overflow-y: auto;
    margin-bottom: 18px;
}

.contact-form textarea.form-control:focus {
    background-color: #ffffff;
    border-color: #1a73e8;
    box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.15);
}

.contact-form textarea.form-control::placeholder {
    color: #6c757d;
    opacity: 0.7;
}

.btn-primary {
    background-color: #1a73e8;
    border: none;
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #1557b0;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(26, 115, 232, 0.3);
}

.contact-info {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
}

.contact-info h5 {
    color: #1a73e8;
    font-weight: 600;
    margin-bottom: 10px;
}

.accordion-button {
    background-color: #ffffff;
    color: #1a73e8;
    font-weight: 500;
    border: 1px solid #e0e0e0;
    border-radius: 8px !important;
    margin-bottom: 8px;
}

.accordion-button:not(.collapsed) {
    background-color: #1a73e8;
    color: #ffffff;
}

.accordion-button:focus {
    box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.2);
}

.accordion-body {
    background-color: #f8f9fa;
    border-radius: 0 0 8px 8px;
    padding: 20px;
}

.card {
    border: none;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

/* Form label styling */
.form-label {
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
}

/* Input group styling */
.input-group {
    margin-bottom: 1.5rem;
}

/* Form section spacing */
.form-section {
    margin-bottom: 2rem;
}

.contact-form .mb-3, .contact-form .mb-4 {
    margin-bottom: 20px !important;
}
</style>

<div class="container mt-5">
    <h1 class="text-center help-title mb-5">Hulp & Ondersteuning</h1>

    <!-- Contact Form Section -->
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card help-section">
                <div class="card-body">
                    <h2 class="card-title mb-4 help-title">Neem Contact Op</h2>
                    <form action="../actions/contact-handler.php" method="POST" class="contact-form">
                        <div class="form-section">
                            <div class="mb-3">
                                <label for="name" class="form-label">Naam</label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="Vul uw naam in">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mailadres</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="Vul uw e-mailadres in">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Onderwerp</label>
                                <select class="form-select" id="subject" name="subject" required>
                                    <option value="">Kies een onderwerp</option>
                                    <option value="reservering">Reservering</option>
                                    <option value="betaling">Betaling</option>
                                    <option value="auto">Auto gerelateerd</option>
                                    <option value="overig">Overig</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="mb-4">
                                <label for="message" class="form-label">Bericht</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required 
                                    placeholder="Typ hier uw bericht..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Verstuur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="col-md-6">
            <div class="card help-section h-100">
                <div class="card-body">
                    <h2 class="card-title mb-4 help-title">Contactgegevens</h2>
                    <div class="contact-info">
                        <div class="mb-4">
                            <h5>Adres</h5>
                            <p>Rydr Autoverhuur<br>
                            Voorbeeldstraat 123<br>
                            1234 AB Amsterdam</p>
                        </div>
                        <div class="mb-4">
                            <h5>Telefoon</h5>
                            <p>+31 (0)20 123 4567</p>
                        </div>
                        <div class="mb-4">
                            <h5>E-mail</h5>
                            <p>info@rydr.nl</p>
                        </div>
                        <div class="mb-4">
                            <h5>Openingstijden</h5>
                            <p>Maandag - Vrijdag: 09:00 - 18:00<br>
                            Zaterdag: 10:00 - 16:00<br>
                            Zondag: Gesloten</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row">
        <div class="col-12">
            <div class="card help-section">
                <div class="card-body">
                    <h2 class="card-title mb-4 help-title">Veelgestelde Vragen</h2>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Wat zijn de vereisten voor het huren van een auto?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Om een auto te huren moet u minimaal 21 jaar oud zijn, een geldig rijbewijs hebben en een geldig identiteitsbewijs kunnen tonen. Daarnaast is een creditcard vereist voor de borg.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Hoe werkt de annuleringsvoorwaarden?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    U kunt uw reservering kosteloos annuleren tot 24 uur voor de geplande ophaaldatum. Bij annulering binnen 24 uur wordt een annuleringskosten in rekening gebracht.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Wat is inbegrepen in de huurprijs?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    De huurprijs omvat onbeperkt aantal kilometers, verzekering, BTW en 24/7 pechhulp. Extra opties zoals GPS en kinderzitjes zijn tegen meerprijs beschikbaar.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../includes/footer.php';
?>