import { router, usePage } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const page = usePage();
const toast = useToast();

export const notifications = () => {

    router.on('finish', () => {
        const message = page.props?.message;

        if(message.content) {
            toast(message.content, {
                type: message.type,
            });
        }
    });
}
