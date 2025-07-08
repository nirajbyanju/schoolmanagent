<!-- Modern Navbar -->
<nav class="bg-white border-b border-gray-200 px-4 py-3 shadow-sm">
  <div class="flex items-center justify-between">
    <!-- Left side - Brand & Breadcrumbs -->
    <div class="flex items-center space-x-4">
      <!-- Sidebar toggle (mobile) -->
      <button id="sidebarToggle" class="lg:hidden text-gray-500 hover:text-gray-700">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>

      <!-- Brand/Logo -->
      <div class="flex items-center">
        <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
        </svg>
        <span class="ml-2 text-xl font-bold text-gray-800">EduPlatform</span>
      </div>

      <!-- Breadcrumbs -->
      <div class="hidden md:flex items-center text-sm">
        <span class="text-gray-500">{{ trans('main-sidebar.' . Route::currentRouteName()) }}</span>
        <span class="mx-2 text-gray-300">/</span>
        <span class="text-gray-700">Dashboard</span>
      </div>
    </div>

    <!-- Right side - User controls -->
    <div class="flex items-center space-x-4">
      <!-- Fullscreen toggle -->
      <button id="fullscreenBtn" class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
        </svg>
      </button>

      <!-- Notifications -->
      <div class="relative">
        <button id="notificationsDropdown" class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full relative">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
          </svg>
          @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
          @endif
        </button>

        <!-- Notifications dropdown -->
        <div id="notificationsMenu" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg overflow-hidden z-50 border border-gray-200">
          <div class="px-4 py-2 bg-gray-50 border-b border-gray-200">
            <h3 class="text-sm font-medium text-gray-700">{{ trans('header.notifications') }}</h3>
          </div>
          
          <div class="max-h-96 overflow-y-auto">
            @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
              @php
                $user = App\Models\User::find($notification->data['comment_author_id']);
              @endphp
              <form method="post" action="{{route('notificationNewComment.remove')}}">
                @method('delete')
                @csrf
                <input type="hidden" value="{{$notification->data['post_id']}}" name="post_id">
                <input type="hidden" value="{{$notification->id}}" name="notification_id">
                <button class="w-full text-left hover:bg-gray-50 transition-colors">
                  <div class="px-4 py-3 border-b border-gray-100">
                    <div class="flex items-start">
                      <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{$notification->data['comment_author_name']}}">
                      <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-900">{{$notification->data['comment_author_name']}}</p>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{$notification->data['comment_content']}}</p>
                        <p class="text-xs text-blue-500 mt-1">{{$notification->created_at->diffForHumans()}}</p>
                      </div>
                    </div>
                  </div>
                </button>
              </form>
            @empty
              <div class="px-4 py-6 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <p class="mt-1 text-sm text-gray-500">{{ trans('header.no-notifications') }}</p>
              </div>
            @endforelse
          </div>

          @if(auth()->user()->unreadNotifications->count() > 5)
            <div class="px-4 py-2 bg-gray-50 border-t border-gray-200 text-center">
              <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                {{ trans('header.view-all') }}
              </a>
            </div>
          @endif
        </div>
      </div>

      <!-- User dropdown -->
      <div class="relative">
        <button id="userDropdown" class="flex items-center space-x-2 focus:outline-none">
          <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-medium">
            {{ substr(auth()->user()->name, 0, 1) }}
          </div>
          <span class="hidden md:inline text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
          <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>

        <!-- User dropdown menu -->
        <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
          <form method="post" action="{{route('logout')}}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              <div class="flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                {{ trans('header.logout') }}
              </div>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</nav>

<script>
  // Toggle dropdowns
  document.addEventListener('DOMContentLoaded', function() {
    // Notifications dropdown
    const notificationsBtn = document.getElementById('notificationsDropdown');
    const notificationsMenu = document.getElementById('notificationsMenu');
    
    notificationsBtn.addEventListener('click', () => {
      notificationsMenu.classList.toggle('hidden');
    });

    // User dropdown
    const userBtn = document.getElementById('userDropdown');
    const userMenu = document.getElementById('userMenu');
    
    userBtn.addEventListener('click', () => {
      userMenu.classList.toggle('hidden');
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
      if (!notificationsBtn.contains(event.target) && !notificationsMenu.contains(event.target)) {
        notificationsMenu.classList.add('hidden');
      }
      if (!userBtn.contains(event.target) && !userMenu.contains(event.target)) {
        userMenu.classList.add('hidden');
      }
    });

    // Fullscreen toggle
    const fullscreenBtn = document.getElementById('fullscreenBtn');
    fullscreenBtn.addEventListener('click', toggleFullscreen);

    function toggleFullscreen() {
      if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch(err => {
          console.error(`Error attempting to enable fullscreen: ${err.message}`);
        });
      } else {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        }
      }
    }
  });
</script>