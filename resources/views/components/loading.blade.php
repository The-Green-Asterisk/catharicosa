<div x-data="{ loading: true }" x-show="loading" @loading.debounce.500ms.window="loading = $event.detail.loading">
    <style>
        .loader {
            border-top-color: #db3434;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
        }

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="fixed inset-0 w-full h-screen z-50 overflow-hidden bg-white flex flex-col items-center justify-center">
        <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
        <h2 class="text-center text-black text-xl font-semibold">Loading....</h2>
    </div>
</div>
<script>
    window.addEventListener('load', () => {
        window.dispatchEvent(
            new CustomEvent('loading', { detail: { loading: false }})
        );
        this.livewire.hook('message.sent', () => {
            window.dispatchEvent(
                new CustomEvent('loading', { detail: { loading: true }})
            )
        });
        this.livewire.hook('message.processed', (message, component) => {
            window.dispatchEvent(
                new CustomEvent('loading', { detail: { loading: false }})
            );
        });
    });
</script>
