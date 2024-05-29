@include('Chatify::layouts.headLinks')
<div class="messenger">


    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>

                {{-- <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">MESSAGES</span> </a> --}}
                {{-- header buttons --}}
                {{-- <nav class="m-header-right">
                    <div class="nav-menu" id="nav-menu">
                        <ul class="nav-list">
                          <li class="nav-item">
                            <a href="{{ route('courses.index') }}" class="nav-link">Mes Cours</a>
                          </li>
                          @auth
                            @if(auth()->user()->isAdmin())
                              <li class="nav-item">
                                <a href="{{ route('admin.courses.index') }}" class="nav-link">Admin</a>
                              </li>
                            @endif
                          @endauth
                        </ul>
                       @auth
                          <ul class="nav-list nav-account" style="margin-top: 1rem">
                              <li class="nav-item" style="width: 100%; text-align: center">
                              <a
                                  href="#"
                                  class="button nav-link"
                                  onclick="getElementById('logout').submit()"
                                  style="display: block; width: 100%"
                                  >Logout</a
                              >
                              <form id="logout" action="{{ route('logout') }}" method="post">
                                      @csrf
                                  </form>
                              </li>
                          </ul>
                       @endauth

                       @guest
                       <ul class="nav-list nav-account" style="margin-top: 1rem">
                              <li class="nav-item" style="width: 100%; text-align: center">
                              <a
                                  href="{{ route('login') }}"
                                  class="button nav-link"
                                  style="display: block; width: 100%"
                                  >Login</a
                              >
                              </li>
                              <li class="nav-item" style="width: 100%; text-align: center">
                              <a
                                  href="{{ route('register') }}"
                                  class="button nav-link"
                                  style="display: block; width: 100%"
                                  >Register</a
                              >
                              </li>
                          </ul>
                       @endguest

                        <div class="nav-close" id="nav-close">
                          <i class="bx bx-x"></i>
                        </div>
                      </div>
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav> --}}
            </nav>
            {{-- Search input --}}
            <input type="text" class="messenger-search" placeholder="Search" />
            {{-- Tabs --}}
            <div class="messenger-listView-tabs">
                <a href="#" class="active-tab" data-view="users">
                    <span class="far fa-user"></span> Contacts</a>
            </div>
        </div>
        {{-- tabs and lists --}}
        <div class="m-body contacts-container">
           {{-- Lists [Users/Group] --}}
           {{-- ---------------- [ User Tab ] ---------------- --}}
           <div class="show messenger-tab users-tab app-scroll" data-view="users">
               {{-- Favorites --}}
               <div class="favorites-section">
                <p class="messenger-title"><span>Favoris</span></p>
                <div class="messenger-favorites app-scroll-hidden"></div>
               </div>
               {{-- Saved Messages --}}
               <p class="messenger-title"><span>Votre espace</span></p>
               {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
               {{-- Contact --}}
               <p class="messenger-title"><span>Discussions</span></p>
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
           </div>
             {{-- ---------------- [ Search Tab ] ---------------- --}}
           <div class="messenger-tab search-tab app-scroll" data-view="search">
                {{-- items --}}
                <p class="messenger-title"><span>Rechercher</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Tapez ici..</span></p>
                </div>
             </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- header back button, avatar and user name --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
            {{-- Internet connection --}}
            <div class="internet-connection">
                <span class="ic-connected">Connecté</span>
                <span class="ic-connecting">Connection...</span>
                <span class="ic-noInternet">Aucun acces internet</span>
            </div>
        </div>

        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Commencer une discussion</span></p>
            </div>
            {{-- Typing indicator --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        {{-- Send Message Form --}}
        @include('Chatify::layouts.sendForm')
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        {{-- nav actions --}}
        <nav>
            <p>Profil</p>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
