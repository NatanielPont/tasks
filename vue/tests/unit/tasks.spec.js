import { expect } from 'chai'
import { mount } from '@vue/test-utils'
import moxios from 'moxios'
import Tasks from '../../../resources/js/components/Tasks.vue'

describe('Tasks.vue', () => {
  beforeEach(function () {
    // import and pass your custom axios instance to this method
    moxios.install(global.axios)
  })

  afterEach(function () {
    // import and pass your custom axios instance to this method
    moxios.uninstall(global.axios)
  })
  it.skip('contains_a_list_of_tasks', () => {
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          { id: 1, name: 'Comprar pa', completed: false },
          { id: 2, name: 'Comprar llet', completed: false },
          { id: 3, name: 'suc', completed: false }
        ]
      }
    })
    console.log(wrapper.text())
    // console.log('text html '.wrapper.html())
    expect(wrapper.text()).contains('Comprar pa')
    expect(wrapper.text()).contains('Comprar llet')
    expect(wrapper.text()).contains('suc')
    expect(wrapper.vm.dataTasks).to.have.lengthOf(3)
    expect(wrapper.vm.dataTasks[0].id).equals(1)
    expect(wrapper.vm.dataTasks[0].name).equals('Comprar pa')
    expect(wrapper.vm.dataTasks[0].completed).equals(false)
  })
  it.only('contains_a_list_of_tasks_from_api_if_no_prop_task_is_provided', () => {
    // const msg = 'new message'
    // preparacio
    moxios.stubRequest('/api/v1/tasks', {
      status: 404,
      response: [
        { id: 1, name: 'Comprar pa', completed: false },
        { id: 2, name: 'Comprar llet', completed: false },
        { id: 3, name: 'suc', completed: false }
      ]
    })

    // execucio
    const wrapper = mount(Tasks)
    // console.log(wrapper.html())
    // moxios.wait(
    console.log(wrapper.text())
    // expect(wrapper.text()).contains('Comprar pa')
    // expect(wrapper.text()).contains('Comprar llet')
    // expect(wrapper.text()).contains('suc')
    // expect(wrapper.vm.dataTasks).to.have.lengthOf(3)
    // expect(wrapper.vm.dataTasks[0].id).equals(1)
    // expect(wrapper.vm.dataTasks[0].name).equals('Comprar pa')
    // expect(wrapper.vm.dataTasks[0].completed).equals(false)
    // )
    // expectation
    // expect(wrapper.text()).to.include(msg)
  })

  it.skip('todo2', () => {

  })
})
