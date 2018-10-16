// import { expect } from 'chai'
import { mount } from '@vue/test-utils'
import Tasks from '../../../resources/js/components/Tasks.vue'

describe('Tasks.vue', () => {
  it.only('contains_a_list_of_tasks', () => {
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          { id: 1, name: 'Comprar pa', completed: false },
          { id: 2, name: 'Comprar llet', completed: false },
          { id: 3, name: 'suc', completed: false }
        ]
      }
    })
    console.log('text '.wrapper.text())
    console.log('text html '.wrapper.html())
  })
  it.skip('shows_nothing_when_no_tasks_provided', () => {
    // const msg = 'new message'
    // preparacio

    // execucio
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: {}
      }
    })
    console.log(wrapper.text())
    // expectation
    // expect(wrapper.text()).to.include(msg)
  })

  it.skip('todo2', () => {

  })
})
