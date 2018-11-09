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

    axios.get(`/api/front/${eventId}`).then(response => {
      this.setState({
        event: response.data,
      })
    })
  }

  render () {
    const {event} = this.state
    let content;
      if(event.logoName) {
        content = <span><img width="40%" src={`/uploads/${event.logoName}`} alt="logo évenement"/></span>;
      }
      else {
        content = <span className="mt-3 mb-4"><img width="40%"  src={`/img/2000px-No_image_available_400_x_600.svg.png`} alt="img_default"/></span>;
      }
      if(event.imageName1) {
        <div className="mt-3 mb-4"><img width="60%"  src={`/uploads/${event.imageName1}`} alt="Image n°1 "/></div>;
      }
      return (
        <div className="row">
          <div className="col lg-4">
            <div>{content}</div>
          </div>
        </div>
      );
  }
}

export default Front