<template>
  <div class="main-notification">
    <div v-click-outside="onOutSideClick" class="btn-group">
      <div
        @click="showNotifications = !showNotifications"
        type="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
      >
        <span
          v-if="unreadNotification > 0"
          class="badge badge-danger rounded-circle notification-badge"
          >{{ unreadNotification }}</span
        >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="20"
          height="20"
          fill="currentColor"
          class="bi bi-bell"
          viewBox="0 0 16 16"
        >
          <path
            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"
          />
        </svg>
      </div>
      <div
        class="dropdown-menu dropdown-menu-right notification-dropdown notification-list-container"
        :class="{ show: showNotifications }"
      >
        <div class="notify-drop-title text-secondary h6">Notifications</div>
        <div
          v-for="(notification, index) in notifications"
          :key="notification.id"
        >
          <div
            class="d-flex p-2 notification-message"
            role="button"
            :class="{ 'border-bottom': index !== notifications.length - 1 }"
            @click.stop="markAsRead(notification)"
          >
            <div
              class="col-9"
              :class="{ 'font-weight-bold': notification.read_at === null }"
            >
              <div>
                {{ notification.data.message }}
              </div>
            </div>
            <div class="col-3 pl-0 pr-1 text-right">
              <small class="text-secondary">{{
                createdDate(notification)
              }}</small>
            </div>
          </div>
        </div>
        <div
          v-show="notifications && notifications.length === 0"
          class="text-center my-3 text-secondary"
        >
          No new notifications
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ClickOutside from "vue-click-outside";
import axios from "axios";

export default {
  name: "Notification",
  directives: {
    ClickOutside,
  },
  data() {
    return {
      showNotifications: false,
      notifications: [],
    };
  },
  computed: {
    unreadNotification() {
      return _.countBy(
        this.notifications,
        (notification) => notification.read_at === null
      ).true;
    },
  },
  async mounted() {
    await this.getNotifications();
  },
  methods: {
    async getNotifications() {
      try {
        const splitUrl = window.location.href.split("/");
        const response = await axios.get(
          `/user/notifications/${splitUrl[splitUrl.length - 1]}`
        );
        this.notifications = response.data;
      } catch (err) {
        console.error(err);
      }
    },
    async markAsRead(notification) {
      if (notification.read_at === null) {
        try {
          await axios.post(`/notification/${notification.id}/mark-as-read`);
          this.getNotifications();
        } catch (err) {
          console.error(err);
        }
      }
    },
    createdDate(notification) {
      return moment(notification.created_at).fromNow();
    },
    onOutSideClick() {
      this.showNotifications = false;
    },
  },
};
</script>
<style scoped>
.notification-dropdown {
  position: absolute;
  transform: translate3d(0px, 38px, 0px);
  top: 0px;
  right: 0px;
  will-change: transform;
  width: 400px;
  max-height: 80vh;
  overflow: auto;
}
.w-45 {
  width: 45px;
}
.dropdown-toggle::after {
  border-top: 0px;
  border-right: 0px;
}
.notify-drop-title {
  border-bottom: 1px solid #e2e2e2;
  padding: 5px 15px 15px 15px;
}
.notification-badge {
  position: absolute;
  top: -7px;
  left: -7px;
}
.notification-message:hover {
  background-color: #f8f9fa;
}
.main-notification {
  margin: 0 3rem;
}

@media only screen and (min-device-width: 320px) and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait) {
  .main-notification {
    margin: 0px;
  }
  .notification-dropdown {
    right: -15px;
    width: 345px;
  }
}
</style>
