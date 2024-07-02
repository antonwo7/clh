import React, { Component } from 'react';
import {connect} from "react-redux";
import * as classNames from "classnames";

class Text extends Component {

    constructor(props) {
        super(props)
        console.log('this.props.value', this.props.value)
    }

    render() {
        const textClassName = 'block w-full flex-1 rounded-none rounded-r-md border border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 text-md px-3' + (this.props.textClassName ? ' ' + this.props.textClassName : '')
        const labelClassName = 'inline-flex items-center rounded-l-md border border-gray-400 bg-gray-200 px-3 text-md text-gray-700' + (this.props.labelClassName ? ' ' + this.props.labelClassName : '') + (typeof this.props.value !== 'undefined' ? ' border-r-0' : ' rounded-r-md w-full font-medium')

        return (
            <div className="flex rounded-md shadow-sm mb-1">
                {this.props.title && <label htmlFor={this.props.id} className={labelClassName}>{this.props.title}</label>}
                {typeof this.props.value !== 'undefined' && <span className={textClassName}>{this.props.value ? this.props.value : ' '}</span>}
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
)(Text);