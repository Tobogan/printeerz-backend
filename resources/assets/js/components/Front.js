import axios from 'axios'
    import React, { Component } from 'react'

    class Front extends Component {
      constructor (props) {
        super(props)
        this.state = {
          event: {}
        }
      }

      componentDidMount () {
        const eventId = this.props.match.params.id

        axios.get(`/api/front/show/${eventId}`).then(response => {
          this.setState({
            event: response.data
          })
        })
      }

      render () {
        const { event } = this.state
        
        return (
          <h1>AHHAHAH</h1>
          <div className='container py-4'>
            <div className='row justify-content-center'>
              <div className='col-md-8'>
                <div className='card'>
                  <div className='card-header'>{event.nom}</div>
                  <div className='card-body'>
                    <p>{event.nom}</p>
                    <h1>HELLO WORLD !</h1>
                    {/* <button className='btn btn-primary btn-sm'>
                      Mark as completed
                    </button>

                    <hr />

                    <ul className='list-group mt-3'>
                      {couleurs.map(task => (
                        <li
                          className='list-group-item d-flex justify-content-between align-items-center'
                          key={task.id}
                        >
                          {task.title}

                          <button className='btn btn-primary btn-sm'>
                            Mark as completed
                          </button>
                        </li>
                      ))}
                    </ul> */}
                  </div>
                </div>
              </div>
            </div>
          </div>
        )
      }
    }

    export default Front