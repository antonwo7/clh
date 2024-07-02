import React, { Component } from 'react';
import {connect} from "react-redux";
import * as classNames from "classnames";

class Select extends Component {

    constructor(props) {
        super(props);

        this.state = {
            value: this.props.value !== undefined ? this.props.value : ''
        }
    }

    changeHandle = value => {
        this.props.onChange && this.props.onChange(value)
        this.setState({ value: value })
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if (this.props.value !== prevProps.value) {
            this.setState({ value: this.props.value })
        }
    }

    render() {
        const selectClassName = 'block w-full flex-1 rounded-none rounded-r-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3' + (this.props.inputClassName ? ' ' + this.props.inputClassName : '') + (!this.props.title ? ' ' + 'rounded-l-md' : '')
        const labelClassName = 'inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500' + (this.props.labelClassName ? ' ' + this.props.labelClassName : '')

        return (
            <div className="flex rounded-md shadow-sm">
                {this.props.title && <label htmlFor={this.props.id} className={labelClassName}>{this.props.title}</label>}
                <select
                    className={selectClassName}
                    value={this.state.value}
                    onChange={e => this.changeHandle(e.target.value)}
                >
                    {this.props.emptyOption && <option value=""></option>}
                    {this.props.options && Object.keys(this.props.options).map(key => (
                        <option value={key} key={key}>{this.props.options[key]}</option>
                    ))}
                </select>
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
)(Select);