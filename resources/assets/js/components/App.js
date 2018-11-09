import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Front from './Front';

class App extends Component {
  render () {
    return (
      <BrowserRouter>
        <div>
          <Switch>
            <Route path='/front/:id' component={Front} />
          </Switch>
        </div>
      </BrowserRouter>
    )
  }
}

if (document.getElementById('app_front')) {
  ReactDOM.render(<App />, document.getElementById('app_front'));
}