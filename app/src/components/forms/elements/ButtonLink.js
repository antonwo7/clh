import React, { Component } from 'react';
import {connect} from "react-redux";
import * as classNames from "classnames";

class ButtonLink extends Component {

    constructor(props) {
        super(props);
        this.state = {

        }
    }

    // async onSave(){
    //     this.setState({ saveLoading: true })
    //
    //     // await savePrice(this.state.date, this.state.price)
    //
    //     this.setState({ saveLoading: false })
    // }

    render() {
        return (
            <div className="mb-4 text-center">
                <button
                    onClick={this.props.onClick ? this.props.onClick : (() => {}) }
                    className="w-full inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                    type="button"
                >{this.props.title}</button>
            </div>
        )
    }
}

export default connect(
    state => {
        return {

        }
    },
    { }
)(ButtonLink);