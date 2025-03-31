<template>
  <Sidebar>
    <SidebarHeader>
      <a href="/" class="flex items-center mb-2 mt-4 ml-2">
        <img src="../../../assets/cooking-light.png" alt="Culina" class="w-7 h-7 flex dark:hidden"/>
        <img src="../../../assets/cooking-dark.png" alt="Culina" class="w-7 h-7 hidden dark:flex"/>
        <h1 class="text-2xl font-semibold leading-none ml-3">Culina</h1>
      </a>
      <span class="flex items-center space-x-3 m-2 text-xs text-gray-500">Explorer et partager des recettes uniques créées par la communauté.</span>
    </SidebarHeader>

    <SidebarContent>

      <SidebarGroup>
        <SidebarGroupLabel>Découvrir</SidebarGroupLabel>
        <SidebarGroupContent>
          <SidebarMenu>
              <SidebarMenuItem v-for="item in menus" :key="item.title">
                <SidebarMenuButton asChild>
                    <a :href="item.url">
                      <component :is="item.icon" />
                      <span>{{item.title}}</span>
                    </a>
                </SidebarMenuButton>
              </SidebarMenuItem>
          </SidebarMenu>
        </SidebarGroupContent>
      </SidebarGroup>

      <div v-if="stateStore.user">
        <SidebarGroup v-if="stateStore.user?.auth === 'admin'">
          <SidebarGroupLabel class="flex flex-row items-center gap-2">Administrateur</SidebarGroupLabel>
          <SidebarGroupContent>
            <SidebarMenu>
                <SidebarMenuItem v-for="item in admin" :key="item.title">
                  <SidebarMenuButton asChild>
                      <a :href="item.url">
                        <component :is="item.icon" />
                        <span>{{item.title}}</span>
                      </a>
                  </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
          </SidebarGroupContent>
        </SidebarGroup>
      </div>

      <SidebarGroup>
        <SidebarGroupLabel v-if="stateStore.user" class="flex flex-row items-center gap-2">{{ stateStore.user?.name }}<TagsList v-if="stateStore.user" :tags="stateStore.user?.auth" /></SidebarGroupLabel>
        <SidebarGroupContent>
          <SidebarMenu>
              <SidebarMenuItem v-for="item in account" :key="item.title">
                <SidebarMenuButton asChild>
                    <a :href="item.url">
                      <component :is="item.icon" />
                      <span>{{item.title}}</span>
                    </a>
                </SidebarMenuButton>
              </SidebarMenuItem>

              <SidebarMenuItem>
                <SidebarMenuButton asChild>
                    <a href="#" class="text-red-500 hover:text-red-600" @click="onLogout">
                      <component :is="LogOutIcon" />
                      <span>Déconnexion</span>
                    </a>
                </SidebarMenuButton>
              </SidebarMenuItem>
          </SidebarMenu>
        </SidebarGroupContent>
      </SidebarGroup>

    </SidebarContent>

    <SidebarFooter>
      <SidebarGroupLabel>Apparence</SidebarGroupLabel>
      <DropdownMenu>
        <DropdownMenuTrigger as-child>
          <Button variant="outline">
            <Icon icon="radix-icons:sun" class="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0" />
            <Icon icon="radix-icons:moon" class="absolute h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100" />
            <span class="sr-only">Toggle theme</span>
          </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent side="top" class="w-[--reka-popper-anchor-width]">
          <DropdownMenuItem @click="mode = 'light'">
            Light
          </DropdownMenuItem>
          <DropdownMenuItem @click="mode = 'dark'">
            Dark
          </DropdownMenuItem>
          <DropdownMenuItem @click="mode = 'auto'">
            System
          </DropdownMenuItem>
        </DropdownMenuContent>
      </DropdownMenu>

      <footer class="text-xs mt-4">
        &copy; 2025 - Culina v.1.1-a
      </footer>
      
    </SidebarFooter>
  </Sidebar>
</template>

<script setup>
  // -------------------------------- Color Mode --------------------------------
  import { useColorMode } from '@vueuse/core'

  const mode = useColorMode();

  // -------------------------------- Menus --------------------------------
  import { Heart, Info, BookOpen, LogOutIcon, Search, MessageCircle } from "lucide-vue-next"

  import {
    Sidebar,
    SidebarContent,
    SidebarGroup,
    SidebarGroupContent,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarHeader,
    SidebarFooter,
  } from "@/components/ui/sidebar"

  import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
  } from "@/components/ui/dropdown-menu"

  import { Button } from '@/components/ui/button'
  import TagsList from '@/components/list/TagsList.vue';
  import { Icon } from '@iconify/vue'

  const menus = [
    { title: 'Explorer', icon: Search, url: '/app/explore' },
  ]

  const account = [
    { title: 'Informations', icon: Info, url: '/app/profile' },
    { title: 'Partagés', icon: BookOpen, url: '/app/shared' },
    { title: 'Favoris', icon: Heart, url: '/app/liked' },
  ]

  const admin = [
    { title: 'Commentaires', icon: MessageCircle, url: '/app/comments' }
  ]

  // -------------------------------- Store --------------------------------
  import { useStateStore } from '@/stores/stateStore';
  const stateStore = useStateStore();

  // -------------------------------- Logout --------------------------------
  import useLoginController from '@/controllers/LoginController';
  const { logout } = useLoginController();
  
  const onLogout = async () => {
    logout();
  };
</script>