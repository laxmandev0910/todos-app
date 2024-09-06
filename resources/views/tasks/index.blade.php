<x-layout title="Todo List">
  <div class="mx-auto max-w-5xl p-8">
    <!-- Page Title-->
    <section class="p-4 mt-12">
      <h1 class="text-left text-vns-lead font-medium text-xl">PHP - Simple To Do List App</h1>
      <hr class="mt-8">
    </section>

    <!-- Page Content-->
    <main class="p-4" x-data="manageTasks">
      <div class="text-center mx-auto mt-8 mb-8">

        <!-- Flash Message-->
        <x-message x-bind:errorType="errorType" x-bind:message="message" />

        <!-- New Task Form -->
        <section class="mt-4 text-center">
          <form id="vns-todo-form" method="POST" x-on:submit.prevent="createTask" accept-charset="UTF-8"
            spellcheck="false" autocomplete="off" novalidate>
            <input type="text" id="vns-title" name="name" placeholder="Enter task name" x-model="newTaskName"
              class="appearance-none focus:outline-none focus-visible:outline-none border p-2 rounded-sm bg-slate-100 border-slate-300 w-80 text-vns-lead">
            <button type="submit"
              class="ml-4 py-2 px-4 border bg-vns-action-alt hover:bg-vns-action text-white rounded-sm">Add
              Task</button>
          </form>
        </section>

        <!-- Show Task List  -->
        <section class="mt-12">

          <!-- Show All Tasks  Section -->
          <div class="bg-vns-action bg-opacity-20 px-8 py-5 text-right" x-cloak
            x-show="taskList.length !== 0 || isCompletedTask">
            <button x-on:click="showTasks()"
              class="ml-3 bg-vns-action-alt text-white px-4 py-2 rounded hover:bg-green-700">
              Show All Task
            </button>
          </div>

          <!-- Task List Table  -->
          <table class="min-w-full bg-white">

            <!-- Table Header Row -->
            <thead>
              <tr class="bg-vns-action bg-opacity-50 text-left text-vns-lead">
                <x-table.th name="S.No." />
                <x-table.th name="Task" />
                <x-table.th name="Status" />
                <x-table.th name="Action" />
              </tr>
            </thead>

            <tbody>
              <!-- No Task available section -->
              <template x-if="taskList.length === 0 && !isCompletedTask">
                <tr>
                  <td colspan="4" class="text-center p-2 w-full">No Tasks available</td>
                </tr>
              </template>
              <!-- List All Tasks -->
              <template x-cloak x-for="task in taskList" :key="task.id">
                <tr class="text-left bg-gray-200">
                  <x-table.td data="task.id" class="w-36" />
                  <x-table.td data="task.name" />
                  <x-table.td data="task.is_completed ? 'Done' : ''" class="w-36" />
                  <x-table.td-action class="w-36">
                    <!-- Complete Task Action Button -->
                    <button x-cloak x-show="!task.is_completed" x-on:click="completeTask($event,task.id)"
                      class="bg-green-600 text-white p-2 rounded hover:bg-green-700">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                      </svg>
                    </button>

                    <!-- Delete Task Action Button -->
                    <button x-on:click="showModel(task.id)"
                      class="ml-3 bg-red-600 text-white p-2 rounded hover:bg-red-700">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                        <path fill-rule="evenodd"
                          d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                          clip-rule="evenodd" />
                      </svg>

                    </button>
                  </x-table.td-action>
                </tr>
              </template>
            </tbody>

          </table>

        </section>
      </div>
      <!-- Modal component -->
      <x-model />
    </main>
  </div>

  <!-- Page Script-->
  <script>
    document.addEventListener("alpine:init", () => {

      //Start: Manage Task Directive
      Alpine.data("manageTasks", () => ({

        //Define Properties
        confirmModelOpen: false,
        isCompletedTask: false,
        newTaskName: '',
        taskList: [],
        taskID: null,
        performDeleteAction: false,
        message: null,
        errorType: true,

        //Define Methods

        /** Initialize task list **/
        init() {
          this.showTasks();
        },

        /** Show task list **/
        async showTasks() {
          try {
            this.isCompletedTask = false;
            const response = await fetch("/api/tasks", {
              method: 'GET',
              headers: {
                'Accept': 'application/json',
              }
            });
            let result = await response.json();
            if (!response.ok) {
              this.showFlashMsg(result.error);
              return;
            }
            this.taskList = result.data;
          } catch (e) {
            console.error(e);
          }
        },

        /** Create new task **/
        async createTask() {
          try {
            let params = {
              'name': this.newTaskName,
            }
            const actionUrl = "/api/tasks";
            const response = await fetch(actionUrl, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify(params)
            });
            this.newTaskName = '';
            let result = await response.json();
            if (!response.ok) {
              this.showFlashMsg(result.error);
              return;
            }
            this.taskList.push(result.data);
            this.showFlashMsg(result.message, false);
          } catch (e) {
            console.log(e);
          }
        },

        /** Complete Existing task **/
        async completeTask(event, taskID) {
          try {
            this.isCompletedTask = true;
            let params = {
              'is_completed': 1,
            }
            const actionUrl = "/api/tasks/" + taskID;
            const response = await fetch(actionUrl, {
              method: 'PATCH',
              headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify(params)
            });
            this.newTaskName = '';
            let result = await response.json();
            if (!response.ok) {
              this.showFlashMsg(result.error);
              return;
            }
            this.removeTaskCompleted(taskID);
            this.showFlashMsg(result.message, false);
          } catch (e) {
            console.error(e);
          }
        },

        /** Delete existing task **/
        async deleteTask() {
          try {
            this.performDeleteAction = true;
            const actionUrl = "/api/tasks/" + this.taskID;
            const response = await fetch(actionUrl, {
              method: 'DELETE',
              headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              }
            });
            let result = await response.json();
            if (!response.ok) {
              this.showFlashMsg(result.error);
              return;
            }
            this.removeTaskCompleted(this.taskID);
            this.showFlashMsg(result.message, false);
          } catch (e) {
            console.error(e);
          } finally {
            this.performDeleteAction = false;
            this.confirmModelOpen = !this.confirmModelOpen;
          }
        },
        async showModel(id) {
          this.taskID = id;
          this.confirmModelOpen = !this.confirmModelOpen;
          this.performDeleteAction = false;
        },
        /** Helper function to hide completed task **/
        async removeTaskCompleted(taskID) {
          this.taskList = this.taskList.filter(task => task.id !== taskID);
        },
        async showFlashMsg(msg, error = true) {
          this.message = msg;
          this.error = error;
          setTimeout(() => {
            this.message = ''
          }, 2000)
        }

      }));// End manageTasks directive

    });//End fn
  </script>
</x-layout>