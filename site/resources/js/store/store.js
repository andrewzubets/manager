import { reactive } from 'vue'

export const store = reactive({
    active_routes: ['home'],
    previous_route: {},
    notifications: [],
    menu: [],
    not_found: {
        is_visible: true,
        message: 'Page not found',
    },
    notify(notificationType, message) {
      this.notifications.push({
          type: notificationType,
          message: message,
      });
    },
    flushNotifications() {
      this.notifications = [];
    },
    setNotFound(is_visible,message) {
        this.not_found = {
            is_visible: is_visible,
            message: message,
        };
    }
})
