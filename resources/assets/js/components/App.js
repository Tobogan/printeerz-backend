import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Header from './Header';
import Front from 'Front';

class App extends Component {
  render () {
    return (
      <BrowserRouter>
        <div>
          {/* <Header /> */}
          
          <Switch>
          
            {/* <Route exact path='/' component={ProjectsList} />
            <Route path='/create' component={NewProject} /> */}
            <Route exact path='/' component={Example} />
            <Route path='/:id' component={Front} />
          </Switch>
        </div>
      </BrowserRouter>
    )
  }
}

ReactDOM.render(<App />, document.getElementById('app'))