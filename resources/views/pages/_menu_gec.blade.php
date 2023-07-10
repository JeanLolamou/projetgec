       <li class="nav-item">
          <a href="" class="nav-link with-sub {{active_route('Courrier.create')}}{{active_route('listCourrierDepart')}}
          {{active_route('listCourrierArrive')}}{{active_route('listCourrierAnnotation')}}{{active_route('listCourrierTraitement')}}{{active_route('listCourrierTraite')}}{{active_route('Courrier.create')}}{{active_route('detailsCourrierDepart')}}{{active_route('Courrier.edit')}}{{active_route('Courrier.update')}}{{active_route('detailCourrierDepart')}}">
            <i class="icon ion-ios-email-outline"></i>
            <span>Courriers</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="{{route('Courrier.create')}}" class="nav-link {{active_route('Courrier.create')}}">Nouveau Courrier</a></li>
            <li class="nav-item"><a href="{{route('listCourrierDepart')}}" class="nav-link {{active_route('listCourrierDepart')}}{{active_route('detailCourrierDepart')}}">Départ</a></li>
            <li class="nav-item"><a href="{{route('listCourrierArrive')}}" class="nav-link {{active_route('listCourrierArrive')}}">Arrivé</a></li>
            <li class="nav-item"><a href="{{route('listCourrierAnnotation')}}" class="nav-link {{active_route('listCourrierAnnotation')}}">En attente d'anotation</a></li>
            <li class="nav-item"><a href="{{route('listCourrierTraitement')}}" class="nav-link {{active_route('listCourrierTraitement')}}">En attente de traitement</a></li>
            <li class="nav-item"><a href="{{route('listCourrierTraite')}}" class="nav-link {{active_route('listCourrierTraite')}}">Traité</a></li>
            
          </ul>
        </li><!-- nav-item -->

         <li class="nav-item">
          <a href="{{route('gestionTypeAnnotation')}}" class="nav-link {{active_route('gestionTypeAnnotation')}}">
            <i class="fa fa-clone" style="font-size: 16px;"></i>
            <span>Type d'annotations</span>
          </a>
        </li><!-- nav-item -->

        <li class="nav-item">
          <a href="{{route('gestionDirection')}}" class="nav-link {{active_route('gestionDirection')}}">
            <i class="fa fa-university" style="font-size: 16px;"></i>
            <span>Directions</span>
          </a>
        </li><!-- nav-item -->

        <li class="nav-item">
          <a href="{{route('gestionService')}}" class="nav-link {{active_route('gestionService')}}">
            <i class="fa fa-building" style="font-size: 16px;"></i>
            <span>Services</span>
          </a>
        </li><!-- nav-item -->

        <li class="nav-item">
          <a href="{{route('gestionGroupe')}}" class="nav-link {{active_route('gestionGroupe')}}">
             <i class="fa fa-user" style="font-size: 16px;"></i>
            <span>Groupes</span>
          </a>
        </li><!-- nav-item -->

        <li class="nav-item">
          <a href="{{route('gestionPoste')}}" class="nav-link {{active_route('gestionPoste')}}">
            <i class="fa fa-list" style="font-size: 16px;"></i>
            <span>Postes</span>
          </a>
        </li><!-- nav-item -->