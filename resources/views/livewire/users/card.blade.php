<div class="w-full p-3">
    <div class="flex text-sm">
        <p class="mr-2 text-[18px] font-black text-gray-800 dark:text-gray-200 leading-non">{{ $userArray['name'] }}:</p>
        <p class="text-gray-500">{{ $userArray['created_at'] }}</p>
    </div>
    <div class="flex flex-wrap text-white">
        <div class="mr-3">
            <div class="min-w-[200px] dark:text-white text-black justify-between flex">
                <div class="flex items-center w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                        <path class="fill-black dark:fill-white" d="M3.125 11.9583H8.54163V10.7083H3.125V11.9583ZM3.125 8.62492H11.0416V7.37496H3.125V8.62492ZM3.125 5.29159H11.0416V4.04163H3.125V5.29159ZM1.50642 15.0833C1.08547 15.0833 0.729167 14.9374 0.4375 14.6458C0.145833 14.3541 0 13.9978 0 13.5768V2.42304C0 2.0021 0.145833 1.64579 0.4375 1.35413C0.729167 1.06246 1.08547 0.916626 1.50642 0.916626H12.6602C13.0812 0.916626 13.4375 1.06246 13.7291 1.35413C14.0208 1.64579 14.1666 2.0021 14.1666 2.42304V13.5768C14.1666 13.9978 14.0208 14.3541 13.7291 14.6458C13.4375 14.9374 13.0812 15.0833 12.6602 15.0833H1.50642ZM1.50642 13.8333H12.6602C12.7243 13.8333 12.7831 13.8066 12.8365 13.7531C12.8899 13.6997 12.9166 13.6409 12.9166 13.5768V2.42304C12.9166 2.35893 12.8899 2.30016 12.8365 2.24673C12.7831 2.19331 12.7243 2.16661 12.6602 2.16661H1.50642C1.44231 2.16661 1.38353 2.19331 1.3301 2.24673C1.27669 2.30016 1.24998 2.35893 1.24998 2.42304V13.5768C1.24998 13.6409 1.27669 13.6997 1.3301 13.7531C1.38353 13.8066 1.44231 13.8333 1.50642 13.8333Z"/>
                    </svg>
                    <span class="ml-1">
                        pages:
                    </span>
                </div>
                <div class="min-w-10">{{ $userArray['stats']['pages_count'] }}</div>
            </div>
            <div class="min-w-[200px] dark:text-white text-black justify-between flex">
                <div class="flex items-center w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path class="fill-black dark:fill-white" d="M3.20834 9.37496H9.4583V8.125H3.20834V9.37496ZM3.20834 6.87496H12.7916V5.625H3.20834V6.87496ZM3.20834 4.37496H12.7916V3.125H3.20834V4.37496ZM0.0833435 15.4486V1.50642C0.0833435 1.08547 0.229177 0.729167 0.520844 0.4375C0.81251 0.145833 1.16882 0 1.58976 0H14.4102C14.8312 0 15.1875 0.145833 15.4791 0.4375C15.7708 0.729167 15.9166 1.08547 15.9166 1.50642V10.9935C15.9166 11.4145 15.7708 11.7708 15.4791 12.0625C15.1875 12.3541 14.8312 12.5 14.4102 12.5H3.03205L0.0833435 15.4486ZM2.50001 11.25H14.4102C14.4743 11.25 14.5331 11.2233 14.5865 11.1699C14.64 11.1164 14.6667 11.0577 14.6667 10.9935V1.50642C14.6667 1.44231 14.64 1.38354 14.5865 1.3301C14.5331 1.27669 14.4743 1.24998 14.4102 1.24998H1.58976C1.52565 1.24998 1.46688 1.27669 1.41345 1.3301C1.36003 1.38354 1.33332 1.44231 1.33332 1.50642V12.4038L2.50001 11.25Z"/>
                    </svg>
                    <span class="ml-1">
                        comments:
                    </span>
                </div>
                <div class="min-w-10">{{ $userArray['stats']['comments_count'] }}</div>
            </div>
        </div>
        <div>
            <div class="min-w-[200px] dark:text-white text-black justify-between flex">
                <div class="flex items-center w-full">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <mask id="mask0_225_876" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="20">
                            <rect width="20" height="20" fill="#D9D9D9"/>
                        </mask>
                        <g mask="url(#mask0_225_876)">
                            <path class="fill-black dark:fill-white" d="M9.99999 16.939L9.08014 16.1121C7.69873 14.8589 6.55637 13.782 5.65305 12.8814C4.74975 11.9807 4.03394 11.1792 3.50564 10.4767C2.97732 9.77427 2.60819 9.13351 2.39826 8.55446C2.18832 7.9754 2.08334 7.3878 2.08334 6.79165C2.08334 5.60897 2.48211 4.61885 3.27966 3.82131C4.0772 3.02377 5.06731 2.625 6.24999 2.625C6.97756 2.625 7.66506 2.79515 8.31249 3.13544C8.95992 3.47572 9.52242 3.96369 9.99999 4.59938C10.4776 3.96369 11.0401 3.47572 11.6875 3.13544C12.3349 2.79515 13.0224 2.625 13.75 2.625C14.9327 2.625 15.9228 3.02377 16.7203 3.82131C17.5179 4.61885 17.9166 5.60897 17.9166 6.79165C17.9166 7.3878 17.8117 7.9754 17.6017 8.55446C17.3918 9.13351 17.0227 9.77427 16.4943 10.4767C15.966 11.1792 15.2516 11.9807 14.3509 12.8814C13.4503 13.782 12.3066 14.8589 10.9198 16.1121L9.99999 16.939ZM9.99999 15.25C11.3333 14.0502 12.4305 13.0219 13.2917 12.165C14.1528 11.3082 14.8333 10.5638 15.3333 9.93188C15.8333 9.29993 16.1805 8.73876 16.375 8.24838C16.5694 7.75799 16.6667 7.27241 16.6667 6.79165C16.6667 5.95831 16.3889 5.26387 15.8333 4.70831C15.2778 4.15276 14.5833 3.87498 13.75 3.87498C13.0919 3.87498 12.4837 4.06168 11.9255 4.43508C11.3672 4.80847 10.9252 5.32797 10.5993 5.99358H9.40064C9.06944 5.32264 8.62607 4.8018 8.07051 4.43106C7.51496 4.06034 6.90811 3.87498 6.24999 3.87498C5.422 3.87498 4.72889 4.15276 4.17066 4.70831C3.61243 5.26387 3.33332 5.95831 3.33332 6.79165C3.33332 7.27241 3.43055 7.75799 3.62499 8.24838C3.81943 8.73876 4.16666 9.29993 4.66666 9.93188C5.16666 10.5638 5.84721 11.3069 6.70832 12.161C7.56943 13.0152 8.66666 14.0449 9.99999 15.25Z"/>
                        </g>
                    </svg>
                    <span class="ml-1">
                        likes:
                    </span>
                </div>
                <div class="min-w-10">{{ $userArray['stats']['likes_count'] }}</div>
            </div>
            <div class="min-w-[200px] dark:text-white text-black justify-between flex">
                <div class="flex items-center w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <mask id="mask0_225_890" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="20">
                            <rect width="20" height="20" fill="#D9D9D9"/>
                        </mask>
                        <g mask="url(#mask0_225_890)">
                            <path class="fill-black dark:fill-white" d="M10.4968 9.70188C10.8515 9.3162 11.1138 8.87337 11.2836 8.37338C11.4535 7.87338 11.5384 7.3579 11.5384 6.82692C11.5384 6.29595 11.4535 5.78047 11.2836 5.28047C11.1138 4.78047 10.8515 4.33763 10.4968 3.95194C11.2286 4.03635 11.8362 4.35232 12.3197 4.89986C12.8031 5.44739 13.0448 6.08974 13.0448 6.82692C13.0448 7.56409 12.8031 8.20645 12.3197 8.75399C11.8362 9.30153 11.2286 9.61749 10.4968 9.70188ZM14.8718 16.0897V14.1346C14.8718 13.6803 14.7794 13.2481 14.5945 12.8379C14.4097 12.4278 14.1474 12.0759 13.8077 11.7821C14.4466 11.9947 15.0347 12.2815 15.5721 12.6426C16.1095 13.0037 16.3782 13.501 16.3782 14.1346V16.0897H14.8718ZM16.3782 10.625V8.9583H14.7115V7.70834H16.3782V6.04167H17.6281V7.70834H19.2948V8.9583H17.6281V10.625H16.3782ZM6.95513 9.74355C6.15306 9.74355 5.46643 9.45797 4.89525 8.8868C4.32409 8.31562 4.0385 7.62899 4.0385 6.82692C4.0385 6.02484 4.32409 5.33822 4.89525 4.76705C5.46643 4.19587 6.15306 3.91028 6.95513 3.91028C7.75721 3.91028 8.44384 4.19587 9.015 4.76705C9.58618 5.33822 9.87177 6.02484 9.87177 6.82692C9.87177 7.62899 9.58618 8.31562 9.015 8.8868C8.44384 9.45797 7.75721 9.74355 6.95513 9.74355ZM0.70517 16.0897V14.2372C0.70517 13.829 0.81601 13.4511 1.03769 13.1034C1.25939 12.7556 1.55559 12.4883 1.92632 12.3013C2.75002 11.8974 3.58095 11.5946 4.41909 11.3926C5.25723 11.1907 6.10257 11.0898 6.95513 11.0898C7.80768 11.0898 8.65303 11.1907 9.49117 11.3926C10.3293 11.5946 11.1602 11.8974 11.984 12.3013C12.3547 12.4883 12.6509 12.7556 12.8726 13.1034C13.0943 13.4511 13.2051 13.829 13.2051 14.2372V16.0897H0.70517ZM6.95513 8.49359C7.41346 8.49359 7.80582 8.3304 8.13221 8.00401C8.4586 7.67762 8.62179 7.28526 8.62179 6.82692C8.62179 6.36859 8.4586 5.97623 8.13221 5.64984C7.80582 5.32345 7.41346 5.16026 6.95513 5.16026C6.49679 5.16026 6.10443 5.32345 5.77804 5.64984C5.45166 5.97623 5.28846 6.36859 5.28846 6.82692C5.28846 7.28526 5.45166 7.67762 5.77804 8.00401C6.10443 8.3304 6.49679 8.49359 6.95513 8.49359ZM1.95513 14.8397H11.9551V14.2372C11.9551 14.0683 11.9063 13.9121 11.8085 13.7684C11.7107 13.6247 11.578 13.5075 11.4103 13.4166C10.6923 13.063 9.96024 12.7951 9.21405 12.6129C8.46786 12.4308 7.71489 12.3397 6.95513 12.3397C6.19538 12.3397 5.44241 12.4308 4.69621 12.6129C3.95003 12.7951 3.21796 13.063 2.5 13.4166C2.33227 13.5075 2.19952 13.6247 2.10177 13.7684C2.00401 13.9121 1.95513 14.0683 1.95513 14.2372V14.8397Z"/>
                        </g>
                    </svg>
                    <span class="ml-1">
                        followers:
                    </span>
                </div>
                <div class="min-w-10">{{ $userArray['stats']['followers_count'] }}</div>
            </div>
        </div>
    </div>
</div>
