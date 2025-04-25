@extends('layout.menu')

@php
  use App\Http\Helpers\ImgHelper;
@endphp

@section('content-menu')
  <div class="container">
    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
    <div class="col-lg-6 px-0">
      <h1 class="display-4 fst-italic">Les voyages : une aventure sans fin !</h1>
      <p class="lead my-3">Chaque voyage nous permet de découvrir des cultures nouvelles, d'explorer des horizons
      inconnus et de créer des souvenirs inoubliables. Nos destinations sont plus qu'un simple déplacement ; elles
      sont une invitation à vivre des moments uniques.</p>
      <p class="lead mb-0"><a href="#" class="text-body-emphasis fw-bold">Prêt à partir à l'aventure ?</a></p>
    </div>
    </div>


    <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary-emphasis" id="discover1">Exploration</strong>
        <h3 class="mb-0">L'émerveillement à chaque étape</h3>
        <div class="mb-1 text-body-secondary">Voyagez au-delà des frontières</div>
        <p class="card-text mb-auto">Nos voyages vous emmènent dans des lieux inattendus, là où l'histoire et la
        nature se rencontrent pour créer une expérience unique.</p>
        <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
        Découvrez le monde
        <svg class="bi" aria-hidden="true">
          <use xlink:href="#chevron-right"></use>
        </svg>
        </a>
      </div>
      <div class="col-auto d-none d-lg-block p-2">
        <img src="{{ ImgHelper::img_section(rand(0, 4)) }}" class="w-100 h-100 rounded-1" alt="">
      </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-success-emphasis" id="discover2">Nouveaux horizons</strong>
        <h3 class="mb-0">Voyager pour se découvrir</h3>
        <div class="mb-1 text-body-secondary">Rencontrez de nouvelles personnes</div>
        <p class="mb-auto">À travers chaque voyage, nous ouvrons nos yeux à de nouvelles perspectives, à des histoires
        inspirantes et à des rencontres enrichissantes.</p>
        <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
        Commencez votre aventure
        <svg class="bi" aria-hidden="true">
          <use xlink:href="#chevron-right"></use>
        </svg>
        </a>
      </div>
      <div class="col-auto d-none d-lg-block p-2">
        <img src="{{ ImgHelper::img_section(rand(5, 7)) }}" class="w-100 h-100 rounded-1" alt="">
      </div>
      </div>
    </div>
    </div>


    <div class="row g-5">
    <div class="col-md-8">
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
      Nos voyages : une aventure à chaque coin du monde
      </h3>

      <article class="blog-post">
      <h2 class="display-5 link-body-emphasis mb-1">Un voyage, un monde à découvrir</h2>
      <p class="blog-post-meta">Janvier 1, 2025 par PHANTHAVONG Bounmy</p>

      <p>Le voyage, c'est bien plus qu'un simple déplacement d'un endroit à un autre. C'est une aventure. C'est un
        appel à l'inconnu, une invitation à dépasser nos frontières personnelles. Imaginez explorer de nouveaux pays,
        vous immerger dans des cultures fascinantes, goûter à des cuisines exotiques, et rencontrer des gens qui
        partagent votre passion pour l'exploration.</p>
      <hr>
      <p>Que ce soit en traversant des montagnes majestueuses, en découvrant des plages paradisiaques ou en explorant
        des villes vibrantes, chaque voyage nous offre une perspective nouvelle sur le monde. Nous vivons des moments
        de pure magie : des couchers de soleil époustouflants, des rencontres inoubliables, et des paysages qui nous
        laissent sans voix.</p>
      <h2>Un monde à portée de main</h2>
      <p>Voyager, c'est ouvrir une porte vers l'inconnu. Chaque destination est une promesse de découverte, de
        curiosité, de beauté et d'émerveillement. Les voyages sont l'occasion de créer des souvenirs qui resteront
        gravés dans notre mémoire, des souvenirs qui nous enrichissent et nous transforment.</p>
      <h3>Les petites découvertes qui changent tout</h3>
      <p>Un simple détour peut parfois mener à des découvertes étonnantes : des ruelles cachées pleines d'histoire,
        des marchés locaux débordant de couleurs, des rencontres impromptues qui nous marquent à vie. Ce sont ces
        moments qui font la beauté de chaque voyage.</p>
      </article>

      <article class="blog-post">
      <h2 class="display-5 link-body-emphasis mb-1">Le voyage, une expérience à partager</h2>
      <p class="blog-post-meta">Décembre 23, 2024 par GUEZO Loïc</p>

      <p>Un voyage n'est pas seulement une aventure personnelle, mais une expérience à partager avec ceux qui nous
        entourent. Que ce soit en partageant des photos, en racontant des anecdotes ou en créant des liens d'amitié
        avec des voyageurs venus des quatre coins du monde, chaque voyage est une occasion de connecter et de tisser
        des liens forts.</p>
      <p>Voyager est aussi un moyen d'apprendre, de grandir et de découvrir des choses sur soi-même que l'on n'aurait
        jamais imaginées avant. La magie réside dans cette capacité à se réinventer à chaque étape du voyage, à chaque
        nouvelle destination.</p>
      </article>

      <section class="airworld-services">
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
        Nos Services : L'expérience AirWorld
      </h3>

      <p>Chez AirWorld, nous croyons que chaque voyage doit être une expérience inoubliable. C'est pourquoi nous
        mettons à votre disposition une gamme de services pour garantir que votre aventure commence dans les
        meilleures conditions.</p>

      <ul class="list-unstyled">
        <li><strong>Réservations faciles :</strong> Grâce à notre plateforme intuitive, réserver votre vol n'a jamais
        été aussi simple. Choisissez votre destination, sélectionnez vos dates et partez à l'aventure en quelques
        clics.</li>
        <li><strong>Options de confort personnalisées :</strong> Que vous voyagiez en classe économique, premium ou
        affaires, AirWorld vous garantit un confort optimal grâce à une sélection de services haut de gamme.</li>
        <li><strong>Vols directs vers les destinations populaires :</strong> AirWorld dessert les plus belles villes
        du monde avec des vols directs, réduisant ainsi votre temps de voyage tout en maximisant votre confort.</li>
        <li><strong>Assistance 24/7 :</strong> Notre équipe est disponible à tout moment pour répondre à vos
        questions, vous aider à planifier votre voyage ou vous fournir des informations essentielles durant votre
        séjour.</li>
      </ul>
      </section>
      <section class="special-offers">
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
        Offres Spéciales : Réservez dès maintenant !
      </h3>

      <p>Profitez de nos offres spéciales et planifiez votre prochain voyage à prix réduit ! AirWorld propose
        régulièrement des promotions et des réductions pour vous aider à voyager plus souvent, tout en respectant
        votre budget.</p>

      <ul class="list-unstyled">
        <li><strong>10% d'augmentation sur votre premier vol :</strong> Inscrivez-vous à notre newsletter pour
        bénéficier d'une augmentation de 10% sur votre première réservation avec AirWorld.</li>
        <li><strong>Vols à partir de 199€ :</strong> Découvrez des destinations de rêve pour un prix imbattable.
        Profitez de nos promotions limitées sur les vols internationaux.</li>
        <li><strong>Forfaits famille :</strong> Voyager en famille n'a jamais été aussi économique. Découvrez nos
        forfaits spéciaux pour les familles et profitez de tarifs réduits pour vos enfants.</li>
      </ul>

      <p>Ne manquez pas ces occasions incroyables et partez à l'aventure avec AirWorld !</p>
      </section>
    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 8rem;">
      <div class="p-4 mb-3 bg-body-tertiary rounded">
        <h4 class="fst-italic">À propos d'AirWorld</h4>
        <p class="mb-0">AirWorld est une compagnie aérienne innovante, dédiée à offrir des voyages confortables et
        sûrs à travers le monde. Découvrez nos services, réservez vos vols et vivez une expérience de voyage sans
        pareil.</p>
      </div>

      <div class="p-4">
        <h4 class="fst-italic">Destinations populaires</h4>
        <ol class="list-unstyled mb-0">
        <li><a href="#">Paris</a></li>
        <li><a href="#">New York</a></li>
        <li><a href="#">Tokyo</a></li>
        <li><a href="#">Londres</a></li>
        <li><a href="#">Sydney</a></li>
        <li><a href="#">Los Angeles</a></li>
        <li><a href="#">Dubai</a></li>
        <li><a href="#">Rome</a></li>
        <li><a href="#">Hong Kong</a></li>
        <li><a href="#">Bangkok</a></li>
        <li><a href="#">Barcelona</a></li>
        <li><a href="#">Berlin</a></li>
        </ol>
      </div>

      <div class="p-4">
        <h4 class="fst-italic">Suivez-nous</h4>
        <ol class="list-unstyled">
        <li><a href="#">Facebook - AirWorld</a></li>
        <li><a href="#">Twitter - @AirWorld</a></li>
        <li><a href="#">Instagram - @airworld_official</a></li>
        <li><a href="#">LinkedIn - AirWorld</a></li>
        </ol>
      </div>
      </div>
    </div>
    </div>
  @endsection