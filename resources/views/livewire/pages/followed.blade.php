<div class="mr-2" @if (Auth::check()) wire:click="@if ($isFollow) unfollow @else follow @endif" @endif>
    <svg class="{{ $isFollow ? 'fill-red-600' : 'dark:fill-white fill-black' }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <mask id="mask0_186_359" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
        <rect width="24" height="24" fill="#DD9D9"/>
        </mask>
        <g mask="url(#mask0_186_359)">
        <path d="M12.0023 15.5769C13.1354 15.5769 14.0977 15.1803 14.8894 14.3872C15.6811 13.594 16.0769 12.6308 16.0769 11.4977C16.0769 10.3646 15.6803 9.40227 14.8872 8.6106C14.094 7.81893 13.1308 7.4231 11.9977 7.4231C10.8647 7.4231 9.90228 7.81968 9.11061 8.61285C8.31895 9.40603 7.92311 10.3692 7.92311 11.5023C7.92311 12.6354 8.3197 13.5977 9.11286 14.3894C9.90605 15.1811 10.8692 15.5769 12.0023 15.5769ZM12 14.2C11.25 14.2 10.6125 13.9375 10.0875 13.4125C9.56251 12.8875 9.30001 12.25 9.30001 11.5C9.30001 10.75 9.56251 10.1125 10.0875 9.5875C10.6125 9.0625 11.25 8.8 12 8.8C12.75 8.8 13.3875 9.0625 13.9125 9.5875C14.4375 10.1125 14.7 10.75 14.7 11.5C14.7 12.25 14.4375 12.8875 13.9125 13.4125C13.3875 13.9375 12.75 14.2 12 14.2ZM12.0014 18.5C9.70177 18.5 7.60645 17.8657 5.71541 16.5971C3.8244 15.3285 2.4321 13.6295 1.53851 11.5C2.4321 9.37052 3.82395 7.67148 5.71406 6.4029C7.60416 5.13432 9.69902 4.50002 11.9986 4.50002C14.2983 4.50002 16.3936 5.13432 18.2846 6.4029C20.1756 7.67148 21.5679 9.37052 22.4615 11.5C21.5679 13.6295 20.1761 15.3285 18.286 16.5971C16.3959 17.8657 14.301 18.5 12.0014 18.5ZM12 17C13.8833 17 15.6125 16.5042 17.1875 15.5125C18.7625 14.5208 19.9667 13.1833 20.8 11.5C19.9667 9.81667 18.7625 8.47917 17.1875 7.4875C15.6125 6.49583 13.8833 6 12 6C10.1167 6 8.38751 6.49583 6.81251 7.4875C5.23751 8.47917 4.03335 9.81667 3.20001 11.5C4.03335 13.1833 5.23751 14.5208 6.81251 15.5125C8.38751 16.5042 10.1167 17 12 17Z">
        </g>
    </svg>
    <!-- <div class="justify-center">
        {{ $followers_count }}
    </div> -->
</div>
