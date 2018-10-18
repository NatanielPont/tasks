/* eslint-disable no-unused-expressions */
import { expect } from 'chai'
import { mount } from '@vue/test-utils'
import moxios from 'moxios'
import Tasks from '../../../resources/js/components/Tasks.vue'

let exampleTasks = [
  {
    id: 1,
    name: 'Comprar pa',
    completed: false
  },
  {
    id: 2,
    name: 'Comprar llet',
    completed: true
  },
  {
    id: 3,
    name: 'Estudiar PHP',
    completed: false
  }

]

describe('Tasks.vue', () => {
  beforeEach(function () {
    moxios.install(global.axios)
  })

  afterEach(function () {
    moxios.uninstall(global.axios)
  })

  it.skip('shows_error', (done) => {
    //
    moxios.stubRequest('/api/v1/tasks', {
      status: 500,
      response: 'Ui que mal'

    })

    // 2 execute
    const wrapper = mount(Tasks)

    // wrapper.vm.errorMessage = 'Ui que mal!'
    // Assertion
    moxios.wait(() => {
      expect(wrapper.text()).contains('Ha succeit un error: Ui que mal')
      done()
    })
  })

  it.skip('not_shows_filters_when_no_tasks', (done) => {
    // prepare
    moxios.stubRequest('/api/v1/tasks', {
      status: 200,
      response: []

    })

    // 2 execute
    const wrapper = mount(Tasks)
    moxios.wait(() => {
      expect(wrapper.text()).not.contains('Filtres:')
      done()
    })

    // wrapper.vm.errorMessage = 'Ui que mal'
    // Assertion
    // expect(wrapper.text()).contains('Filtros:').to.be.false
  })

  it.skip('shows_filters_when_is_more_than_0_tasks', () => {
    // 2 execute
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: exampleTasks
      }
    })

    wrapper.vm.errorMessage = 'Ui que mal!'
    // Assertion

    expect(wrapper.text()).contains('Filtros:')
  })

  it.skip('contains_a_list_of_tasks', () => {
    // 1 PREPARE (OPTIONAL)

    // 2 EXECUTE
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: exampleTasks
      }
    }) // <tasks tasks="[{},{},{}]"></tasks>

    expect(wrapper.text()).contains('Comprar pa')
    expect(wrapper.text()).contains('Comprar llet')
    expect(wrapper.text()).contains('Estudiar PHP')
    //
    // // wrapper.vm -> Objecte Vue (vm: View Model)
    // expect(wrapper.vm.dataTasks).to.have.lengthOf(3)
    // expect(wrapper.vm.dataTasks[0].id).equals(1)
    // expect(wrapper.vm.dataTasks[0].name).equals('Comprar pa')
    // expect(wrapper.vm.e[0].completed).equals(false)
    //
    // expect(wrapper.vm.dataTasks[1].id).equals(2)
    // expect(wrapper.vm.dataTasks[1].name).equals('Comprar llet')
    // expect(wrapper.vm.dataTasks[1].completed).equals(true)
    //
    // expect(wrapper.vm.dataTasks[2].id).equals(3)
    // expect(wrapper.vm.dataTasks[2].name).equals('Estudiar PHP')
    // expect(wrapper.vm.dataTasks[2].completed).equals(false)
  })

  it.skip('shows_error_when_api_fails', (done) => {
    // 1 Prepare (opcional)
    moxios.stubRequest('/api/v1/tasks', {
      status: 500,
      response: {
        data: 'Ha petat tot estrepitosament'
      }
    })

    // 2 Execució
    const wrapper = mount(Tasks) // <tasks></tasks>
    expect(wrapper.text()).contains('Ha petat tot estrepitosament')
  })

  it.skip('contains_a_list_of_tasks_from_api_if_no_prop_tasks_is_provided', (done) => {
    // 1 Prepare (opcional)
    moxios.stubRequest('/api/v1/tasks', {
      status: 200,
      response: exampleTasks
    })

    // 2 Execució
    const wrapper = mount(Tasks) // <tasks></tasks>

    // 3 expectations
    moxios.wait(() => {
      expect(wrapper.text()).contains('Comprar pa')
      expect(wrapper.text()).contains('Comprar llet')
      expect(wrapper.text()).contains('Estudiar PHP')

      // eslint-disable-next-line no-unused-expressions
      expect(wrapper.find('span#task2').classes('strike')).to.be.true

      done()
    })
  })
  it.only('add_a_task', (done) => {
    // prepare
    moxios.stubRequest('/api/v1/tasks', {
      status: 200,
      response: {
        id: 34,
        name: 'Comprar lejia',
        completed: false
      }
    })

    // execute
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: exampleTasks
      }
    })
    // input name tasks
    // console.log(wrapper.find("input[name='name']").html())
    let inputName = wrapper.find("input[name='name']")
    console.log('inputname')
    console.log(wrapper.find("input[name='name']"))
    inputName.element.value = 'Comprar lejia'
    inputName.trigger('input')
    // inputName.trigger('click')
    let button = wrapper.find('button#button_add_task')
    button.trigger('click')
    console.log('Value name')
    console.log(inputName.element)
    console.log('text')
    console.log(wrapper.text())

    // assert
    moxios.wait(() => {
      expect(wrapper.text()).contains('Comprar lejia')
      done()
    })
  })
  it.skip('delete_a_task', () => {

  })

  it.skip('add_task_with_enter', () => {
    // prepare

    // execute
    const wrapper = mount(Tasks)
    // input name tasks
    // console.log(wrapper.find("input[name='name']").html())
    let inputName = wrapper.find("input[name='name']")
    inputName.value = 'Comprar lejia'
    inputName.trigger('input')
  })
})

// describe('Tasks.vue', () => {
//   beforeEach(function () {
//     // import and pass your custom axios instance to this method
//     moxios.install(global.axios)
//   })
//
//   afterEach(function () {
//     // import and pass your custom axios instance to this method
//     moxios.uninstall(global.axios)
//   })
//   it.skip('contains_a_list_of_tasks', () => {
//     const wrapper = mount(Tasks, {
//       propsData: {
//         tasks: [
//           { id: 1, name: 'Comprar pa', completed: false },
//           { id: 2, name: 'Comprar llet', completed: false },
//           { id: 3, name: 'suc', completed: false }
//         ]
//       }
//     })
//     console.log(wrapper.text())
//     // console.log('text html '.wrapper.html())
//     expect(wrapper.text()).contains('Comprar pa')
//     expect(wrapper.text()).contains('Comprar llet')
//     expect(wrapper.text()).contains('suc')
//     expect(wrapper.vm.dataTasks).to.have.lengthOf(3)
//     expect(wrapper.vm.dataTasks[0].id).equals(1)
//     expect(wrapper.vm.dataTasks[0].name).equals('Comprar pa')
//     expect(wrapper.vm.dataTasks[0].completed).equals(false)
//   })
//   it.skip('contains_a_list_of_tasks_from_api_if_no_prop_task_is_provided', (done) => {
//     // const msg = 'new message'
//     // preparacio
//     moxios.stubRequest('/api/v1/tasks', {
//       status: 404,
//       response: [
//         { id: 1, name: 'Comprar pa', completed: false },
//         { id: 2, name: 'Comprar llet', completed: false },
//         { id: 3, name: 'suc', completed: false }
//       ]
//     })
//
//     // execucio
//     const wrapper = mount(Tasks)
//     // console.log(wrapper.html())
//     // console.log(wrapper.html())
//     moxios.wait(() => {
//       expect(wrapper.text()).contains('Comprar pa')
//       expect(wrapper.text()).contains('Comprar llet')
//       expect(wrapper.text()).contains('suc')
//       // expect(wrapper.html()).contains('<span class="strike">Estudiar PHP</span>')
//       expect(wrapper.find('span#task2').classes(0)).equals('strike')
//       done()
//     }
//     )
//     // expect(wrapper.text()).contains('Comprar pa')
//     // expect(wrapper.text()).contains('Comprar llet')
//     // expect(wrapper.text()).contains('suc')
//     // expect(wrapper.vm.dataTasks).to.have.lengthOf(3)
//     // expect(wrapper.vm.dataTasks[0].id).equals(1)
//     // expect(wrapper.vm.dataTasks[0].name).equals('Comprar pa')
//     // expect(wrapper.vm.dataTasks[0].completed).equals(false)
//     // )
//     // expectation
//     // expect(wrapper.text()).to.include(msg)
//   })
//
//   it.only('shows_error', () => {
//     // 2 execute
//     const wrapper = mount(Tasks)
//
//     wrapper.vm.errorMessage = 'Ui que mal!'
//     // Assertion
//
//     expect(wrapper.text()).contains('Ui que mal!')
//   })
//   it.skip('show_filters_when_is_more_than_0_tasks', () => {
//     const wrapper = mount(Tasks)
//     wrapper.vm.errorMessage = 'salió wrong!!'
//     expect(wrapper.text()).contains('Filtros:')
//   })
// })
