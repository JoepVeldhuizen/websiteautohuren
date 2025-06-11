<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Leer meer over onze autoverhuur service. Ontdek waarom klanten voor ons kiezen, onze geschiedenis en onze toewijding aan kwaliteit en klantenservice.">
    <title>Over Ons - Auto Verhuur</title>
    <link rel="stylesheet" href="/rydr/websiteautohuren/rental-main/public/css/style.css">
</head>
<body>
<?php require "../includes/header.php" ?>
<main class="about-container">
    <section class="hero-section">
        <img src="./assets/images/banner.webp" alt="Rydr kantoor in Rotterdam" class="hero-image">
        <div class="hero-content">
            <h1>Over Rydr</h1>
            <p class="hero-subtitle">Uw partner in mobiliteit sinds 2020</p>
        </div>
    </section>

    <section class="about-section">
        <div class="about-grid">
            <div class="about-content">
                <h2>Onze Missie</h2>
                <p>Bij Rydr geloven we dat mobiliteit voor iedereen toegankelijk moet zijn. Ons hoofdkantoor bevindt zich in het bruisende hart van Rotterdam, direct naast het Centraal Station. Hier combineren we technologie, design en klantgerichtheid onder één dak.</p>
                <p>In een modern pand met uitzicht op de skyline werken we elke dag aan de mobiliteit van morgen. Loop je een keer binnen? De koffie staat klaar.</p>
            </div>
            <div class="about-image">
                <img src="./assets/images/work-place.webp" alt="Rydr kantoor interieur" class="office-image">
            </div>
        </div>
    </section>

    <section class="values-section">
        <h2>Onze Kernwaarden</h2>
        <div class="values-grid">
            <div class="value-card">
                <h3>Kwaliteit</h3>
                <p>We bieden alleen de beste voertuigen aan, zorgvuldig geselecteerd en regelmatig onderhouden.</p>
            </div>
            <div class="value-card">
                <h3>Betrouwbaarheid</h3>
                <p>U kunt altijd op ons rekenen, 24/7 beschikbaar voor al uw vragen en ondersteuning.</p>
            </div>
            <div class="value-card">
                <h3>Innovatie</h3>
                <p>We blijven voorop lopen in de mobiliteitsrevolutie met de nieuwste technologieën.</p>
            </div>
        </div>
    </section>

    <section class="team-section">
        <h2>Ons Team</h2>
        <p class="team-intro">Ons ervaren team staat klaar om u te helpen met al uw mobiliteitsvragen. Van het selecteren van de perfecte auto tot het bieden van uitstekende service tijdens uw huurperiode.</p>
        <div class="team-grid">
            <div class="team-card">
                <img src="./assets/images/team/brian-mensah.webp" alt="Brian Mensah" class="team-image">
                <h3>Brian Mensah</h3>
                <p>Teamlid</p>
            </div>
            <div class="team-card">
                <img src="./assets/images/team/jasper-van-den-brink.webp" alt="Jasper van den Brink" class="team-image">
                <h3>Jasper van den Brink</h3>
                <p>Teamlid</p>
            </div>
            <div class="team-card">
                <img src="./assets/images/team/lotte-de-graaf.webp" alt="Lotte de Graaf" class="team-image">
                <h3>Lotte de Graaf</h3>
                <p>Teamlid</p>
            </div>
            <div class="team-card">
                <img src="./assets/images/team/youssef-amrani.webp" alt="Youssef Amrani" class="team-image">
                <h3>Youssef Amrani</h3>
                <p>Teamlid</p>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <h2>Klaar om te beginnen?</h2>
        <p>Ontdek ons uitgebreide aanbod aan voertuigen en ervaar het Rydr verschil.</p>
        <a href="/rydr/websiteautohuren/rental-main/pages/autos.php" class="btn btn-primary">Bekijk ons aanbod</a>
    </section>
</main>

<style>
.about-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.hero-section {
    position: relative;
    margin-bottom: 4rem;
}

.hero-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 12px;
}

.hero-content {
    position: absolute;
    bottom: 2rem;
    left: 2rem;
    color: #ffffff;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.hero-content h1 {
    font-size: 3rem;
    margin-bottom: 0.5rem;
}

.hero-subtitle {
    font-size: 1.5rem;
}

.about-section {
    margin-bottom: 4rem;
}

.about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.about-content h2 {
    font-size: 2rem;
    margin-bottom: 1.5rem;
    color: #000000;
}

.about-content p {
    margin-bottom: 1rem;
    line-height: 1.6;
}

.office-image {
    width: 100%;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.values-section {
    margin-bottom: 4rem;
    text-align: center;
}

.values-section h2 {
    font-size: 2rem;
    margin-bottom: 2rem;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.value-card {
    background: #ffffff;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.2s ease-in-out;
}

.value-card:hover {
    transform: translateY(-5px);
}

.value-card h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #000000;
}

.team-section {
    margin-bottom: 4rem;
    text-align: center;
}

.team-section h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.team-intro {
    max-width: 800px;
    margin: 0 auto 2rem;
    line-height: 1.6;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
}

.team-card {
    background: #ffffff;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.team-image {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 1rem;
}

.team-card h3 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: #000000;
}

.cta-section {
    text-align: center;
    padding: 4rem 2rem;
    background: #f8f8f8;
    border-radius: 12px;
    margin-bottom: 4rem;
}

.cta-section h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.cta-section p {
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .about-grid,
    .values-grid,
    .team-grid {
        grid-template-columns: 1fr;
    }

    .hero-content h1 {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1.25rem;
    }

    .about-grid {
        gap: 2rem;
    }
}
</style>

<?php require "../includes/footer.php" ?>
</body>
</html>
