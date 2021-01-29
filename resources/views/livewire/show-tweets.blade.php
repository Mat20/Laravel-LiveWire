<div>
    <h3 class="text-4xl py-6 font-bold h-24" >Poste algo, diga-me como foi o seu dia!</h3>

    <h3><p>{{ $message }}</p></h3>

    <form method="post" wire:submit.prevent="create" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
      <label class="block text-gray-700 text-sm font-bold mb-4" for="username">
        Tweet
    </label>
        <textarea name="message" id="message" rows="5" placeholder="O que está pensando?" wire:model="message" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('message') border-red-500 @enderror"></textarea>
        @error('message') <p><span class="text-red-500">{{ $message }}</span></p> @enderror
        <button type="submit" class="bg-blue-900 text-white p-2 pl-6 pr-6 rounded">
            <b>Fazer Tweet</b>
        </button>
    </form>

    @foreach ($tweets as $tweet)
       <div class="flex m-8 bg-white shadow-md rounded p-4">
        <div class="w-1/8 pl-3 text-center">
          @if ($tweet->user->photo)
          <img src="{{ url("storage/{$tweet->user->photo}")  }}" alt="{{ $tweet->user->name }}" class="rounded-full h-8 w-8">
          @else
              <img src="{{ url('assets/no_image.jpg')  }}" alt="{{ $tweet->user->name }}" class="rounded-full h-8 w-8">
          @endif
          <b>{{ $tweet->user->name }}
         </div>
         <div class="w-7/8 pl-3 inline-block align-text-middle">
          {{ $tweet->message }}<br>
          (
          @if ($tweet->likes->count())
            <a href="#" wire:click.prevent="unlike( {{ $tweet->id }})">Descurti</a>
          @else
            <a href="#" wire:click.prevent="like( {{ $tweet->id }})">Curti</a>
          @endif
          )
         </div>
       </div>
        <br>
    @endforeach
     <div class="py-12">
       {{ $tweets->links() }}
     </div>
</div>
