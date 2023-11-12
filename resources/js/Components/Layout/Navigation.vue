<script setup>
import {inject} from "vue";
import {HomeIcon, UsersIcon} from "@heroicons/vue/24/outline/index.js";
import {Link} from "@inertiajs/vue3";

const dynastyId = inject('dynastyId')

const mainNavItems = [
    {
        name: 'Dashboard',
        href: route('dynasty.index'),
        icon: HomeIcon,
        current: route().current("dynasty.index")
    }
]

const dynastyNavItems = [
    {
        name: 'Home',
        icon: HomeIcon,
        route: 'dynasty.show'
    },
    {
        name: 'Teams',
        icon: UsersIcon,
        route: 'conference.index'
    }
]
</script>

<template>
  <nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
      <li>
        <ul role="list" class="-mx-2 space-y-1">
          <li v-for="item in mainNavItems" :key="item.name">
            <Link :href="item.href"
                  :class="[item.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
              <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true"/>
              {{ item.name }}
            </Link>
          </li>
        </ul>
      </li>
      <li>
        <div class="text-xs font-semibold leading-6 text-gray-400">Your dynasties</div>
        <ul role="list" class="-mx-2 mt-2 space-y-1">
          <li v-for="dynasty in $page.props.dynasties" :key="dynasty.id">
            <Link :href="route('dynasty.show', { id: dynasty.id })"
                  class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
              <span
                  class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-[0.625rem] font-medium text-gray-400 group-hover:text-white">{{ dynasty.name[0] }}</span>
              <span class="truncate">{{ dynasty.name }}</span>
            </Link>

            <ul v-show="dynastyId === dynasty.id" class="pl-4 py-2">
              <li v-for="item in dynastyNavItems" :key="item.name">
                <Link :href="route(item.route, { id: dynasty.id })"
                      :class="[route().current(item.route, { id: dynasty.id }) ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                  <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true"/>
                  {{ item.name }}
                </Link>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</template>
