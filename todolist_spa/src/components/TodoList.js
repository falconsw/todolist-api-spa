import React, { Component } from "react";

class TodoList extends Component {
    componentDidUpdate() {
        this.props.inputElement.current.focus();
    }

    render() {
        return (
            <div className="mt-10 mr-5">
                <h1 className="text-3xl font-bold text-center text-white border border-gray-600 p-3">Todo List</h1>
                <div className="mt-10"></div>

                <div className="flex">

                    <form onSubmit={this.props.addItem} className="flex">
                        <div className="flex items-center mr-4">
                            <input
                                className="border-2 border-gray-900 p-2 w-full"
                                placeholder="Add a todo"
                                ref={this.props.inputElement}
                                value={this.props.currentItem.name}
                                onChange={this.props.handleInput}
                            />
                        </div>
                        <div className="flex items-center mr-4">
                            <button type="submit"
                                    className="bg-gray-400 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Add Todo
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        )
    }
}

export default TodoList;