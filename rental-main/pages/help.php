<?php
require_once '../includes/header.php';
?>

<link rel="stylesheet" href="../public/assets/css/help.css">

<div class="container mt-5">
    <h1 class="text-center help-title mb-5">Hulp & Ondersteuning</h1>

    <!-- Quick Support Options -->
    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="support-option">
                <i class="fas fa-phone-alt"></i>
                <h4>Direct Bellen</h4>
                <p>Bel ons direct voor snelle hulp</p>
                <a href="tel:+31201234567" class="btn btn-primary">+31 (0)20 123 4567</a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="support-option">
                <i class="fas fa-comments"></i>
                <h4>Live Chat</h4>
                <p>Start een gesprek met onze support</p>
                <button class="btn btn-primary" onclick="startLiveChat()">Start Chat</button>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="support-option">
                <i class="fas fa-envelope"></i>
                <h4>E-mail Support</h4>
                <p>Stuur ons een e-mail</p>
                <a href="mailto:info@rydr.nl" class="btn btn-primary">info@rydr.nl</a>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="help-section">
                <div class="contact-form-container">
                    <h2 class="text-center mb-4">Neem Contact Op</h2>
                    <form action="../actions/contact-handler.php" method="POST">
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="name" class="form-label">Naam</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Vul uw naam in">
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="email" class="form-label">E-mailadres</label>
                                    <input type="email" class="form-control" id="email" name="email" required placeholder="Vul uw e-mailadres in">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject" class="form-label">Onderwerp</label>
                            <select class="form-select" id="subject" name="subject" required>
                                <option value="">Kies een onderwerp</option>
                                <option value="reservering">Reservering</option>
                                <option value="betaling">Betaling</option>
                                <option value="auto">Auto gerelateerd</option>
                                <option value="overig">Overig</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="form-label">Bericht</label>
                            <textarea class="form-control" id="message" name="message" required placeholder="Typ hier uw bericht..."></textarea>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn-submit">
                                Verstuur Bericht
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card help-section h-100">
                <div class="card-body">
                    <h2 class="card-title mb-4 help-title">Contactgegevens</h2>
                    <div class="contact-info">
                        <div class="mb-4">
                            <h5><i class="fas fa-map-marker-alt me-2"></i>Adres</h5>
                            <p>Rydr Autoverhuur<br>
                            Voorbeeldstraat 123<br>
                            1234 AB Amsterdam</p>
                        </div>
                        <div class="mb-4">
                            <h5><i class="fas fa-phone me-2"></i>Telefoon</h5>
                            <p>+31 (0)20 123 4567</p>
                        </div>
                        <div class="mb-4">
                            <h5><i class="fas fa-envelope me-2"></i>E-mail</h5>
                            <p>info@rydr.nl</p>
                        </div>
                        <div class="mb-4">
                            <h5><i class="fas fa-clock me-2"></i>Openingstijden</h5>
                            <p>Maandag - Vrijdag: 09:00 - 18:00<br>
                            Zaterdag: 10:00 - 16:00<br>
                            Zondag: Gesloten</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works Section -->
        <div class="col-md-6">
            <div class="card help-section">
                <div class="card-body">
                    <h2 class="card-title mb-4 help-title">Hoe Werkt Het?</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="help-subtitle">Reserveringsproces</h3>
                            <ol class="help-steps">
                                <li>Kies uw gewenste auto en huurperiode</li>
                                <li>Vul uw persoonlijke gegevens in</li>
                                <li>Bevestig uw reservering en betaal</li>
                                <li>Ontvang uw bevestiging per e-mail</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <h3 class="help-subtitle">Ophaalproces</h3>
                            <ol class="help-steps">
                                <li>Kom naar ons kantoor op de afgesproken tijd</li>
                                <li>Toon uw rijbewijs en identiteitsbewijs</li>
                                <li>Onderteken de huurovereenkomst</li>
                                <li>Start uw reis met uw huurauto</li>
                            </ol>
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

                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Hoe werkt de brandstofvoorziening?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    De auto wordt met een volle tank afgeleverd. U kunt de auto met een volle tank terugbrengen of wij brengen de ontbrekende brandstof in rekening tegen het huidige markttarief.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    Wat gebeurt er bij schade aan de auto?
                                </button>
                            </h3>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Bij schade aan de auto dient u direct contact op te nemen met onze pechhulpdienst. Maak foto's van de schade en vul het schadeformulier in. De verzekering dekt de schade volgens de voorwaarden van uw gekozen verzekeringspakket.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function startLiveChat() {
    // Implementatie van live chat functionaliteit
    alert('Live chat wordt binnenkort geïmplementeerd.');
}
</script>

<?php
require_once '../includes/footer.php';
?>